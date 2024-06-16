<?php

namespace App\Http\Controllers;

use App\Models\Addresse;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductCtr extends Controller
{
    function detail($slug){

        $data['product'] = Product::where('slug',$slug)->first();
        $data['product_relate'] = Product::where('slug','<>',$slug)->limit(4)->get();
        return view('product-detail',$data);
    }

    function addcart($id) {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart',[]);

        if(isset($cart[$id])){
            $cart[$id]['qty']++;
        }else{
            $cart[$id] = [
                'product_id' => $id,
                'product_name' => $product->name,
                'price' => $product->price,
                'qty' => 1,
                'thumbnail' => $product->thumbnail
            ];
        }

        session()->put('cart',$cart);
        return redirect()->back()->with('add','เพิ่มสินค้าเรียบร้อย');
    }

    function cart() {
        // session()->invalidate();
        // session()->regenerateToken();
        return view('product-cart');
    }

    function removecart(Request $request) {
        if($request->id){
            $cart = session()->get('cart');
            if(isset($cart[$request->id])){
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }

            session()->flash('success','ลบรายการสิ้นค้าสำเร็จ');
        }
    }

    function updatecart(Request $request) {
        if($request->id && $request->qty){
            $cart = session()->get('cart');
            $cart[$request->id]['qty'] = $request->qty;
            session()->put('cart', $cart);

            session()->flash('success','เพิ่มรายการสิ้นค้าสำเร็จ');
        }
    }

    function checkout() {
        return view('product-checkout');
    }

    function comfirmcheckout(Request $request) {
        $data = $request->all();
        $request->validate(
            [
                'name' => 'required',
                'lastname' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'province' => 'required',
                'district' => 'required',
                'subdistrict' => 'required',
                'postcode' => 'required',
            ],
            [
                'required' => '* ข้อมูลที่จำเป็น',
                'email' => '* รูปแบบอีเมลไม่ถูกต้อง',
            ]
        );
        
        $customer = Customer::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
        ]);
        $c_id = $customer->id; //get customer id

        $address = Addresse::create([
            'customer_id' => $c_id,
            'address' => $data['address'],
            'province' => $data['province'],
            'district' => $data['district'],
            'subdistrict' => $data['subdistrict'],
            'postcode' => $data['postcode']
        ]);
        $a_id = $address->id; //get address id

        $total = 0;
        foreach (session('cart') as $id => $detail){
            $total += $detail['price'] * $detail['qty'];
        }

        $order = Order::create([
            'customer_id' => $c_id,
            'address_id' => $a_id,
            'total_price' => $total,
        ]);
        $o_id = $order->id; //get order id

        foreach (session('cart') as $id => $detail){
            Orderdetail::create([
                'order_id' => $o_id,
                'product_id' => $detail['product_id'],
                'qty' => $detail['qty'],
            ]);
        }
        
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('home')->with('checkedout', 'รายการสั่งซื้อเรียบร้อย');
    }
}
