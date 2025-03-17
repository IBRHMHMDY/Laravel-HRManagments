@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">تعديل الوردية</h2>
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('shifts.update', $shift->id) }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">اسم الوردية:</label>
            <input type="text" name="name" class="w-full p-2 border border-gray-300 rounded" value="{{ $shift->name }}" required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">وقت البداية:</label>
            <input type="text" name="start_time" value="{{ \Carbon\Carbon::parse($shift->start_time)->format('H:i') }}" class="w-full p-2 border border-gray-300 rounded">
            @error('start_time')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">وقت النهاية:</label>
            <input type="text" name="end_time" value="{{ \Carbon\Carbon::parse($shift->end_time)->format('H:i') }}" class="w-full p-2 border border-gray-300 rounded">
            @error('end_time')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            تحديث
        </button>
    </form>
</div>
@endsection
