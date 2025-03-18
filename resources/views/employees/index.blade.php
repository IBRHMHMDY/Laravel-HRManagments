@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">قائمة الموظفين</h2>

    <!-- رسائل التنبيه -->
    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('employees.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">إضافة موظف جديد</a>

    <table class="w-full mt-4 border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 p-2">الاسم</th>
                <th class="border border-gray-300 p-2">البريد الإلكتروني</th>
                <th class="border border-gray-300 p-2">رقم الهاتف</th>
                <th class="border border-gray-300 p-2">القسم</th>
                <th class="border border-gray-300 p-2">الوردية</th>
                <th class="border border-gray-300 p-2">نوع الراتب</th>
                <th class="border border-gray-300 p-2">الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
            <tr class="border border-gray-300">
                <td class="p-2">{{ $employee->name }}</td>
                <td class="p-2">{{ $employee->email }}</td>
                <td class="p-2">{{ $employee->phone }}</td>
                <td class="p-2">{{ $employee->department->name ?? 'غير محدد' }}</td>
                <td class="p-2">{{ $employee->shift->name ?? 'غير محدد' }}</td>
                <td class="p-2">{{ $employee->salary_type == 'fixed' ? 'راتب ثابت' : 'بالساعة' }}</td>
                <td class="p-2 flex space-x-2 gap-4">
                    <a href="{{ route('employees.show', $employee->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded-md">عرض تفاصيل</a>
                    <a href="{{ route('employees.edit', $employee->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded-md">تعديل</a>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded-md">حذف</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
