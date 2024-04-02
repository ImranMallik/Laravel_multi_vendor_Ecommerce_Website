<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return view('Admin.admin_dashboard');
    }

    public function login(){
        return view('Admin.Auth.login');
    }
}
