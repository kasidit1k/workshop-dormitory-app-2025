<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    // เมธอดแสดงหน้า Dashboard
    public function dashboard()
    {
        // แสดง resources/views/dashboard.blade.php
        return view('dashboard');
        
    }
}
