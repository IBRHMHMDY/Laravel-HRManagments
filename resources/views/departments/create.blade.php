@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md mt-10">
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">إضافة قسم جديد</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('departments.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-1">اسم القسم</label>
            <input type="text" name="name" id="name"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500
                @error('name') border-red-500 @enderror"
                value="{{ old('name') }}">

            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="w-full py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
            حفظ
        </button>

    </form>
</div>
@endsection
