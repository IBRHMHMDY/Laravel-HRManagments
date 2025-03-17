@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">تعديل الوردية</h2>

    <form action="{{ route('shifts.update', $shift->id) }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">اسم الوردية:</label>
            <input type="text" name="name" class="w-full p-2 border border-gray-300 rounded" value="{{ $shift->name }}" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">وقت البداية:</label>
            <input type="text" name="start_time" value="{{ $shift->start_time }}" class="w-full p-2 border border-gray-300 rounded">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">وقت النهاية:</label>
            <input type="text" name="end_time" value="{{ $shift->end_time }}" class="w-full p-2 border border-gray-300 rounded">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            تحديث
        </button>
    </form>
</div>
@endsection
