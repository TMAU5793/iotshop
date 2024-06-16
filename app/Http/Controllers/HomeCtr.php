<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class HomeCtr extends Controller
{
    function index(){

        $data['products'] = Product::where('status','1')->get();
        return view('index', $data);
    }
}
