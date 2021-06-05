<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dasbor.list');
    }

    public function level()
    {
        return view('admin.user.level');
    }

    public function user()
    {
        return view('admin.user.user');
    }

    public function product()
    {
        return view('admin.dasbor.item');
    }
}
