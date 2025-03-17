@extends('layouts.app')

@section('title', 'تعديل القسم')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 shadow-lg rounded-lg">
    <h1 class="text-3xl font-bold mb-4">تعديل القسم</h1>

    <form action="{{ route('departments.update', $department->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="block mb-2">اسم القسم:</label>
        <input type="text" name="name" value="{{ $department->name }}" class="border p-2 w-full mb-4" required>

        <button type="submit" class="p-2 bg-blue-500 text-white rounded">تحديث</button>
    </form>
</div>
@endsection
