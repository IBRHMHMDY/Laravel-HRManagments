<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Salary;

class DashboardController extends Controller
{
    public function index()
    {
        // 📊 إحصائيات عامة
        $employeeCount = Employee::count();
        $departmentCount = Department::count();
        // $presentCount = Attendance::where('status', 'حاضر')->count();
        // $leaveCount = Attendance::where('status', 'قيد الانتظار')->count();
        $totalSalaries = Salary::sum('total_salary');

        // 📈 إرسال البيانات إلى `dashboard/index.blade.php`
        return view('dashboard.index', compact(
            'employeeCount',
            'departmentCount',
            // 'presentCount',
            // 'leaveCount',
            'totalSalaries'
        ));
    }
}
