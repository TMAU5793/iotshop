<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardCtr extends Controller
{
    function index() {
        return view('admin.dashboard');
    }
}
