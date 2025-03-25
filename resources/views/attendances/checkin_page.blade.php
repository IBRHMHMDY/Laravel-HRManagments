@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">تسجيل الحضور</h2>

    @if(session('message'))
        <div class="bg-green-200 text-green-800 p-3 rounded-md mb-4">
            {{ session('message') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-200 text-red-800 p-3 rounded-md mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('attendances.checkin') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        <!-- اختيار الموظف -->
        <div class="mb-4">
            <label for="employee_id" class="block text-gray-700 font-medium mb-1">الموظف</label>
            <select name="employee_id" id="employee_id" class="w-full p-2 border rounded-md">
                <option value="">اختر الموظف</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
            @error('employee_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- اختيار الوردية -->
        <div class="mb-4">
            <label for="shift_id" class="block text-gray-700 font-medium mb-1">الوردية</label>
            <select name="shift_id" id="shift_id" class="w-full border border-gray-300 rounded-lg p-2 mt-2">
                <option value="">اختر الوردية</option>
                @foreach($shifts as $shift)
                    <option value="{{ $shift->id }}">{{ $shift->name }} ({{ $shift->start_time }} - {{ $shift->end_time }} - {{ $shift->id }})</option>
                @endforeach
            </select>
            @error('shift_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <!-- اختيار الحالة -->
        <div class="mb-4">
            <label for="status" class="block text-gray-700 font-medium mb-1">الحالة</label>
            <select name="status" id="status" class="w-full border border-gray-300 rounded-lg p-2 mt-2">
                <option value="present">حاضر</option>
                <option value="late">متأخر</option>
                <option value="absent">غائب</option>
                <option value="on_leave">في إجازة</option>
            </select>
            @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="flex items-center gap-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">تسجيل</button>
            <a href="{{ route('attendances.index') }}" class="ml-4 text-gray-600">العودة للقائمة</a>
        </div>
    </form>
</div>
@endsection
