<?php

namespace App\Http\Controllers;

use App\Library\JsonRes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        // $value = $request->session()->get('key');
        // $this->middleware(function ($request, $next) { });
        if (!session('statusLogin')) {
            return redirect()->route('login')->with('status', 'Login dulu bray!');
        }
    }

    public function index()
    {
        return view('admin.dashboard.dasbor');
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
        return view('admin.dashboard.item');
    }

    public function order()
    {
        return view('admin.transaction.order');
    }
    public function transaction()
    {
        return view('admin.transaction.transaksi');
    }
    public function laporan()
    {
        return view('admin.transaction.laporan');
    }
}
