@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">تفاصيل الموظف</h2>

        <!-- صورة افتراضية للموظف -->
        <div class="flex justify-center mb-6">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($employee->name) }}&background=random&color=fff&size=128" class="w-32 h-32 rounded-full shadow-md" alt="Employee Avatar">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-gray-600 font-semibold">الاسم:</p>
                <p class="text-lg font-medium text-gray-800">{{ $employee->name }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">البريد الإلكتروني:</p>
                <p class="text-lg font-medium text-gray-800">{{ $employee->email }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">رقم الهاتف:</p>
                <p class="text-lg font-medium text-gray-800">{{ $employee->phone }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">العنوان:</p>
                <p class="text-lg font-medium text-gray-800">{{ $employee->address ?? 'غير متوفر' }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">تاريخ الميلاد:</p>
                <p class="text-lg font-medium text-gray-800">{{ $employee->birth_date }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">تاريخ الانضمام:</p>
                <p class="text-lg font-medium text-gray-800">{{ $employee->join_date }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">القسم:</p>
                <p class="text-lg font-medium text-gray-800">{{ $employee->department->name ?? 'غير محدد' }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">الوردية:</p>
                <p class="text-lg font-medium text-gray-800">{{ $employee->shift->name ?? 'غير محددة' }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">نوع الراتب:</p>
                <p class="text-lg font-medium text-gray-800">
                    {{ $employee->salary_type == 'fixed' ? 'راتب ثابت' : 'بالساعة' }}
                </p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">الراتب الثابت:</p>
                <p class="text-lg font-medium text-gray-800">
                    {{ $employee->salary_type == 'fixed' ? number_format($employee->fixed_salary, 2) . ' $' : 'غير متاح' }}
                </p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">سعر الساعة:</p>
                <p class="text-lg font-medium text-gray-800">
                    {{ $employee->salary_type == 'hourly' ? number_format($employee->hourly_rate, 2) . ' $' : 'غير متاح' }}
                </p>
            </div>
        </div>

        <!-- الأزرار -->
        <div class="mt-6 flex justify-center space-x-4 gap-4">
            <a href="{{ route('employees.edit', $employee->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-600">تعديل</a>
            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-red-600">حذف</button>
            </form>
            <a href="{{ route('employees.index') }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-gray-600">العودة للقائمة</a>
        </div>
    </div>
</div>
@endsection
