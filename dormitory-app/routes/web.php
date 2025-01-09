<?php 

// ใช้ namespace Route เพื่อกำหนดเส้นทาง (Route) สำหรับการเข้าถึง URL ต่าง ๆ ในแอปพลิเคชัน
use Illuminate\Support\Facades\Route;

// เรียกใช้งาน Controllers สำหรับหน้า Dashboard
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BillingController;

// เส้นทางสำหรับหน้าแรกของแอปพลิเคชัน
Route::get('/', function () {
    return view('welcome'); // แสดงหน้า "welcome.blade.php"
});

// เส้นทางสำหรับหน้า Dashboard
// ใช้ DashboardController และเรียกเมธอด dashboard เพื่อประมวลผล
Route::get('/dashboard', [DashboardController::class, 'dashboard']);

Route::get('/company/index', [CompanyController::class, 'index']);

Route::get('/room', [RoomController::class, 'index']);

Route::get('/customer', [CustomerController::class, 'index']);

Route::get('/pay', [PayController::class, 'index']);

Route::get('/user', [UserController::class, 'index']);

Route::get('/billing', [BillingController::class, 'index']);

Route::get('/print-billing/{billingId}', [BillingController::class, 'printBilling']);

Route::get('/print-invoice/{id}', [BillingController::class, 'printInvoice']);
