@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">إضافة وردية جديدة</h2>
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('shifts.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">اسم الوردية:</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full p-2 border border-gray-300 rounded" required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">وقت البداية:</label>
            <input type="text" name="start_time" value="{{ old('start_time') }}" class="w-full p-2 border border-gray-300 rounded" placeholder="24:00:00">
            @error('start_time')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">وقت النهاية:</label>
            <input type="text" name="end_time" value="{{ old('end_time') }}" class="w-full p-2 border border-gray-300 rounded" placeholder="24:00:00">
            @error('end_time')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            حفظ
        </button>
    </form>
</div>
@endsection

