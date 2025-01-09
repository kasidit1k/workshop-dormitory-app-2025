<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    // เป็นเมธอดที่ใช้แสดงหน้า Dashboard
    public function dashboard()
    {
        // แสดงไฟล์ที่อยู่ใน resources/views/dashboard.blade.php
        return view('dashboard');
        
    }
}
