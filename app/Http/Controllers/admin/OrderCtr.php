<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Orderdetail;
use Illuminate\Http\Request;

class OrderCtr extends Controller
{
    function index() {
        $data['data'] = Order::select('orders.*','orders.id as orderId','customers.*')
            ->join('customers','orders.customer_id','=','customers.id')
            ->orderBy('orders.created_at','DESC')->paginate(25);
        return view('admin.order',$data);
    }

    function detail($id) {
        $data['data'] = Order::where('id',$id)->first();
        $data['customer'] = Customer::where('id', $data['data']->customer_id)->first();
        $data['orderlist'] = Orderdetail::join('products','orderdetails.product_id','=','products.id')->where('orderdetails.order_id', $id)->get();

        return view('admin.order-detail',$data);
    }
}
