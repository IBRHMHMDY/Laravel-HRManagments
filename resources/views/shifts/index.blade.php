@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto bg-white p-6 shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold mb-6 text-gray-700">إدارة الشيفتات</h2>
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ route('shifts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">إضافة شيفت جديد</a>

        <table class="w-full mt-4 border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2">اسم الشيفت</th>
                    <th class="p-2">وقت البدء</th>
                    <th class="p-2">وقت الانتهاء</th>
                    <th class="p-2">عدد الساعات</th>
                    <th class="p-2">إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($shifts as $shift)
                    <tr class="border-b">
                        <td class="p-2">{{ $shift->name }}</td>
                        <td class="p-2">{{ \Carbon\Carbon::parse($shift->start_time)->format('H:i') }}</td>
                        <td class="p-2">{{ \Carbon\Carbon::parse($shift->end_time)->format('H:i') }}</td>
                        <td class="p-2">{{ $shift->hours_works }}</td>
                        <td class="p-2">
                            <a href="{{ route('shifts.edit', $shift->id) }}" class="text-blue-500">تعديل</a>
                            <form action="{{ route('shifts.destroy', $shift->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
