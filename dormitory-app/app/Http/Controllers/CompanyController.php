<?php 

namespace App\Http\Controllers;

class CompanyController extends Controller
{
    // เมธอด index แสดงหน้า company.blade.php
    public function index()
    {
        // แสดง views/company.blade.php
        return view('company');
    }
}