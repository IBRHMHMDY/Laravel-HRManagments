@extends('layouts.app')

@section('content')
<div class="max-w-6xl md:max-w-5xl mx-auto bg-white p-6 shadow-lg rounded-lg">
    <h2 class="text-3xl font-bold mb-6 text-gray-700">لوحة التحكم</h2>
    <!-- الإحصائيات -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-green-500 text-white p-4 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">عدد الأقسام</h3>
            <p class="text-2xl">{{ $departmentCount }}</p>
        </div>
        <div class="bg-blue-500 text-white p-4 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">إجمالي الموظفين</h3>
            <p class="text-2xl">{{ $employeeCount }}</p>
        </div>
        {{-- <div class="bg-yellow-500 text-white p-4 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">الحضور اليوم</h3>
            <p class="text-2xl">{{ $todayAttendances }}</p>
        </div>
        <div class="bg-red-500 text-white p-4 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">الإجازات المعتمدة اليوم</h3>
            <p class="text-2xl">{{ $approvedLeavesToday }}</p>
        </div>
        <div class="bg-red-500 text-white p-4 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">الغيابات اليوم</h3>
            <p class="text-2xl">{{ $approvedLeavesToday }}</p>
        </div> --}}
        <div class="bg-purple-500 text-white p-4 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">إجمالي المرتبات المستحقة</h3>
            <p class="text-2xl">{{ number_format($totalSalaries, 2) }} ج.م</p>
        </div>
        {{-- <div class="bg-red-100 p-4 rounded">
            <h3 class="text-xl font-bold text-red-600">إجمالي الغيابات</h3>
            <p>{{ $total_absences }} يوم</p>
        </div>
        <div class="bg-yellow-100 p-4 rounded">
            <h3 class="text-xl font-bold text-yellow-600">إجمالي التأخير</h3>
            <p>{{ $total_late_minutes }} دقيقة</p>
        </div>
        <div class="bg-green-100 p-4 rounded">
            <h3 class="text-xl font-bold text-green-600">إجمالي الإضافي</h3>
            <p>{{ $total_overtime }} ساعة</p>
        </div>
        <div class="bg-blue-100 p-4 rounded">
            <h3 class="text-xl font-bold text-blue-600">إجمالي الخصومات</h3>
            <p>{{ $total_deductions }} جنيه</p>
        </div> --}}
    </div>
</div>

@endsection
