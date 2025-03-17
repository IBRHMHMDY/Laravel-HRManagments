<?php

use App\Http\Controllers\AdjustmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\ShiftController;
use Illuminate\Support\Facades\Route;

// صفحة تسجيل الدخول والتسجيل
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// لوحة التحكم
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// الأقسام
Route::prefix('departments')->name('departments.')->group(function () {
    Route::get('/', [DepartmentController::class, 'index'])->name('index');
    Route::get('/create', [DepartmentController::class, 'create'])->name('create');
    Route::post('/store', [DepartmentController::class, 'store'])->name('store');
    Route::get('/{department}/edit', [DepartmentController::class, 'edit'])->name('edit');
    Route::put('/{department}', [DepartmentController::class, 'update'])->name('update');
    Route::delete('/{department}', [DepartmentController::class, 'destroy'])->name('destroy');
    Route::post('/{department}/restore', [DepartmentController::class, 'restore'])->name('restore');
});

// الورديات
Route::prefix('shifts')->name('shifts.')->group(function () {
    Route::get('/', [ShiftController::class, 'index'])->name('index');
    Route::get('/create', [ShiftController::class, 'create'])->name('create');
    Route::post('/store', [ShiftController::class, 'store'])->name('store');
    Route::get('/{shift}/edit', [ShiftController::class, 'edit'])->name('edit');
    Route::put('/{shift}', [ShiftController::class, 'update'])->name('update');
    Route::delete('/{shift}', [ShiftController::class, 'destroy'])->name('destroy');
});

// الموظفون
Route::prefix('employees')->name('employees.')->group(function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('index');
    Route::get('/create', [EmployeeController::class, 'create'])->name('create');
    Route::post('/store', [EmployeeController::class, 'store'])->name('store');
    Route::get('/{employee}', [EmployeeController::class, 'show'])->name('show');
    Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->name('edit');
    Route::put('/{employee}', [EmployeeController::class, 'update'])->name('update');
    Route::delete('/{employee}', [EmployeeController::class, 'destroy'])->name('destroy');
});

// الحضور والانصراف
Route::prefix('attendance')->name('attendances.')->group(function () {
    Route::get('/', [AttendanceController::class, 'index'])->name('index');
    Route::get('/create', [AttendanceController::class, 'create'])->name('create');
    Route::post('/store', [AttendanceController::class, 'store'])->name('store');
    Route::get('/{attendance}/edit', [AttendanceController::class, 'edit'])->name('edit');
    Route::put('/{attendance}', [AttendanceController::class, 'update'])->name('update');
    Route::delete('/{attendance}', [AttendanceController::class, 'destroy'])->name('destroy');
});

// التعديلات المالية
Route::prefix('adjustments')->name('adjustments.')->group(function () {
    Route::get('/', [AdjustmentController::class, 'index'])->name('index');
    Route::get('/create', [AdjustmentController::class, 'create'])->name('create');
    Route::post('/store', [AdjustmentController::class, 'store'])->name('store');
    Route::get('/{adjustment}/edit', [AdjustmentController::class, 'edit'])->name('edit');
    Route::put('/{adjustment}', [AdjustmentController::class, 'update'])->name('update');
    Route::delete('/{adjustment}', [AdjustmentController::class, 'destroy'])->name('destroy');
});

// الرواتب
Route::prefix('salaries')->name('salaries.')->group(function () {
    Route::get('/', [SalaryController::class, 'index'])->name('index');
    Route::get('/{salary}', [SalaryController::class, 'show'])->name('show');
});

// التقارير
Route::prefix('reports')->name('reports.')->group(function () {
    Route::get('/attendance', [ReportController::class, 'attendance'])->name('attendance');
    Route::get('/salaries', [ReportController::class, 'salaries'])->name('salaries');
});

// صفحات الخطأ
Route::fallback(function () {
    return view('errors.404');
});
