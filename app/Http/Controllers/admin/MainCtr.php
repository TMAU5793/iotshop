<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Models\User;

class MainCtr extends Controller
{

    function index (){
        if(auth()->user()){
            return redirect()->route('admin.product');
        }else{
            return view('admin.login');
        }
    }

    function auth(Request $request) {
        $post = $request->all();

        $request->validate(
            [
                'username' => 'required',
                'password' => 'required'
            ],
            [
                'required' => '* ข้อมูลที่จำเป็น'
            ]
        );
        
        
        if(auth()->attempt(['username' => $post['username'], 'password' => $post['password']])){
            if(auth()->user()->is_admin == 1){
                return redirect()->route('admin.product');
            }
        }
        
        return redirect()->route('admin.login')->with('error','ชื่อผู้ใช้ หรือรหัสผ่านไม่ถูกต้อง');
    }

    function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
    function tinymceUpload(Request $request) {
        $fileName = $request->file('file')->getClientOriginalName();

        // $imgpath = request()->file('file')->store('../../uploads/tinymce', 'public');
        // $imgpath = request()->file('file')->store('uploads/tinymce', 'public');

        // return response()->json(['location' => url("/storage/$imgpath")]);
        // return response()->json(['location' => 'https://grasp.asia/appdemo/laravel/storage/app/public/'.$imgpath ]);
    }
}
