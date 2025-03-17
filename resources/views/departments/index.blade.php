@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 shadow-lg rounded-lg">

    <h2 class="text-2xl font-bold mb-4">إدارة الأقسام</h2>
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif
    <div class="flex justify-between">
        <a href="{{ route('departments.create') }}" class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">
            + إضافة قسم جديد
        </a>

        <form method="GET" action="{{ route('departments.index') }}" class="mb-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="ابحث عن قسم..."
                class="border p-2 rounded">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">بحث</button>
        </form>
    </div>

    <div>
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">الاسم</th>
                    <th class="border p-2">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($departments as $department)
                    <tr>
                        <td class="border p-2">{{ $department->name }}</td>
                        <td class="border p-2 text-center ">
                            <a href="{{ route('departments.edit', $department) }}" class="text-blue-500">تعديل</a>
                            <form action="{{ route('departments.destroy', $department) }}"
                                    method="POST" class="inline" onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذا القسم؟');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-5">
        <h2 class="text-xl font-semibold my-4">الأقسام المحذوفة</h2>
        <table class="w-full border-collapse border border-gray-300 mt-5">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2">اسم القسم</th>
                    <th class="border px-4 py-2">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deletedDepartments as $department)
                <tr>
                    <td class="border px-4 py-2">{{ $department->name }}</td>
                    <td class="border px-4 py-2">
                        <form action="{{ route('departments.restore', $department->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                                استعادة
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- <div class="mt-4">
        {{ $departments->links() }}
    </div> --}}
</div>
@endsection
