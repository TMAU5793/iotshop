<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use File;

use App\Models\Product;

class ProductCtr extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['data'] = Product::orderBy('created_at','DESC')
            ->paginate(25);

        return view('admin.product', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['action'] = 'store';
        return view('admin.product-form',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate(
            [
                'product_code' => 'required|unique:products,product_code',
                'name' => 'required',
                'price' => 'required',
                'stock' => 'required',
                'slug' => 'required',
            ],
            [
                'required' => '* ข้อมูลที่จำเป็น',
                'email' => '* รูปแบบอีเมลไม่ถูกต้อง',
                'product_code' => [
                    'unique' => '* รหัสสินค้าถูกใช้งานแล้ว'
                ],
            ]
        );
        $status = (isset($data['cb_status']) && $data['cb_status'] == 'on' ? '1' : '0');
        $insert = Product::create([
            'product_code' => $data['product_code'],
            'name' => $data['name'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'shortdesc' => $data['shortdesc'],
            'description' => $data['description'],
            'status' => $status,
            'slug' => $data['slug']
        ]);

        $id = $insert->id;
        if($request->hasFile('thumbnail')){

            // use on server
            // $path_url = public_path('../../uploads/products');

            // use on local
            $path_url = public_path('uploads/products');

            if(!File::isDirectory($path_url)){
                File::makeDirectory($path_url, 0777, true, true);                
            }

            $this->uploadImg($data['thumbnail'] ,$id , $path_url);

        }

        return redirect()->route('admin.product')->with('status', 'เพิ่มข้อมูลเรียบร้อย');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['action'] = 'update';
        $data['data'] = Product::where('id',$id)->first();
        return view('admin.product-form',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $request->validate(
            [
                // 'product_code' => 'required|unique:products,product_code',
                'name' => 'required',
                'price' => 'required',
                'stock' => 'required',
                'slug' => 'required',
            ],
            [
                'required' => '* ข้อมูลที่จำเป็น',
                'email' => '* รูปแบบอีเมลไม่ถูกต้อง',
                'product_code' => [
                    'unique' => '* รหัสสินค้าถูกใช้งานแล้ว'
                ],
            ]
        );
        $status = (isset($data['cb_status']) && $data['cb_status'] == 'on' ? '1' : '0');
       
        $update = [
            'product_code' => $data['product_code'],
            'name' => $data['name'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'shortdesc' => $data['shortdesc'],
            'description' => $data['description'],
            'status' => $status,
            'slug' => $data['slug']
        ];

        Product::where('id',$data['hd_id'])->update($update);

        if($request->hasFile('thumbnail')){

            // use on server
            // $path_url = public_path('../../uploads/products');

            // use on local
            $path_url = public_path('uploads/products');

            if(!File::isDirectory($path_url)){
                File::makeDirectory($path_url, 0777, true, true);                
            }

            $pathImg = $data['hd_path'];
            // use on server
            // if(file_exists(public_path('../../'.$pathImg))){
            //     File::delete(public_path('../../'.$pathImg));
            // }

            // use on local
            if(file_exists(public_path($pathImg))){
                File::delete(public_path($pathImg));
            }
            $this->uploadImg($data['thumbnail'] , $data['hd_id'] , $path_url);

        }

        return redirect()->route('admin.product')->with('status', 'เพิ่มข้อมูลเรียบร้อย');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uploadImg($file , $id , $path_url) {

        $input['imagename'] = 'profile-'.time().'.'.$file->extension();

        $img = Image::make($file->path());
        $img->resize(600, 700, function ($const) {
            $const->aspectRatio();
        })->save($path_url.'/'.$input['imagename']);

        $info = [
            'thumbnail' => '/uploads/products/'.$input['imagename']
        ];

        Product::where('id', $id)->update($info);
        
        return true;
    }
}
