@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">إضافة موظف جديد</h2>

    <!-- رسائل الخطأ -->
    @if ($errors->any())
        <div class="bg-red-500 text-white p-3 rounded-md mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employees.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf

        <label class="block">الاسم:</label>
        <input type="text" name="name" class="w-full p-2 border rounded-md" required>

        <label class="block mt-2">العنوان:</label>
        <input type="text" name="address" class="w-full p-2 border rounded-md">

        <label class="block mt-2">رقم الهاتف:</label>
        <input type="text" name="phone" class="w-full p-2 border rounded-md" required>

        <label class="block mt-2">البريد الإلكتروني:</label>
        <input type="email" name="email" class="w-full p-2 border rounded-md" required>

        <label class="block mt-2">تاريخ الميلاد:</label>
        <input type="date" name="birth_date" class="w-full p-2 border rounded-md" required>

        <label class="block mt-2">تاريخ التعيين:</label>
        <input type="date" name="join_date" class="w-full p-2 border rounded-md" required>

        <label class="block mt-2">القسم:</label>
        <select name="department_id" class="w-full p-2 border rounded-md">
            @foreach($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </select>

        <label class="block mt-2">الوردية:</label>
        <select name="shift_id" class="w-full p-2 border rounded-md">
            <option value="">بدون وردية</option>
            @foreach($shifts as $shift)
                <option value="{{ $shift->id }}">{{ $shift->name }}</option>
            @endforeach
        </select>

        <label class="block mt-2">نوع الراتب:</label>
        <select name="salary_type" class="w-full p-2 border rounded-md">
            <option value="fixed">راتب ثابت</option>
            <option value="hourly">بالساعة</option>
        </select>

        <label class="block mt-2">الراتب الثابت:</label>
        <input type="number" name="fixed_salary" class="w-full p-2 border rounded-md">

        <label class="block mt-2">سعر الساعة:</label>
        <input type="number" name="hourly_rate" class="w-full p-2 border rounded-md">

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md mt-4">إضافة</button>
    </form>
</div>
@endsection
