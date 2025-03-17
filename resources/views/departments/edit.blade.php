@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md mt-10">
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">تعديل القسم</h2>



    <form action="{{ route('departments.update', $department->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-1">اسم القسم</label>
            <input type="text" name="name" id="name"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500
                @error('name') border-red-500 @enderror"
                value="{{ old('name', $department->name) }}">

            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700 transition">
            تحديث
        </button>
    </form>
</div>
@endsection
