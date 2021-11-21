<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_dashboards'])->only('index');
    }
    public function index()
    {
        $main_sidebar=1;
        return view('backend/dashboard',compact('main_sidebar'));
    }
}
