<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BillingController;

Route::get('/', function () {
    return view('welcome');
});

// ส่วนของการเรียกใช้งาน DashboardController โดยใช้ Route
Route::get('/dashboard', [DashboardController::class, 'dashboard']);

// ส่วนของการเรียกใช้งาน CompanyController โดยใช้ Route
Route::get('/company/index', [CompanyController::class, 'index']);

// ส่วนของการเรียกใช้งาน RoomController โดยใช้ Route
Route::get('/room', [RoomController::class, 'index']);

// ส่วนของการเรียกใช้งาน CustomerController โดยใช้ Route
Route::get('/customer', [CustomerController::class, 'index']);

// ส่วนของการเรียกใช้งาน PayController โดยใช้ Route
Route::get('/pay', [PayController::class, 'index']);

// ส่วนของการเรียกใช้งาน SigninController โดยใช้ Route
Route::get('/user', [UserController::class, 'index']);

// ส่วนของการเรียกใช้งาน BillingController โดยใช้ Route
Route::get('/billing', [BillingController::class, 'index']);

// ส่วนของการปริ้นใบแจ้งหนี้ โดยใช้ Route และส่งค่าไปยัง Controller ด้วย {billingId} ที่ระบุ 
Route::get('/print-billing/{billingId}', [BillingController::class, 'printBilling']);
