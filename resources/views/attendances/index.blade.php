@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex items-center justify-between  mb-6">
        <h2 class="text-2xl font-bold">سجل الحضور والانصراف</h2>
        <div class="flex items-center gap-6">
            <a href="{{ route('attendances.checkinPage') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                تسجيل حضور موظف
            </a>
            <a href="{{ route('attendances.checkoutPage') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                تسجيل إنصراف موظف
            </a>
        </div>
    </div>

    @if(session('error'))
        <div class="bg-red-200 text-red-800 p-3 rounded-md mb-4">
            {{ session('error') }}
        </div>
    @endif

    <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-gray-200">
            <tr class="text-center">
                <th class="p-3">الموظف</th>
                <th class="p-3">الوردية</th>
                <th class="p-3">وقت الحضور الرسمى</th>
                <th class="p-3">وقت الحضور الفعلى</th>
                <th class="p-3">الحالة</th>
                <th class="p-3">مدة التأخير</th>
                <th class="p-3">الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
            <tr class="border-b text-center">
                <td class="p-3">{{ $attendance->employee->name }}</td>
                <td class="p-3">{{ $attendance->shift->name }}</td>
                <td class="p-3">{{ \Carbon\Carbon::parse($attendance->shift->start_time)->format('H:i') }}</td>
                <td class="p-3">{{ \Carbon\Carbon::parse($attendance->check_in)->format('H:i') }}</td>
                <td class="p-3">
                    @if($attendance->status == 'present')
                        <span class="text-green-600 font-bold">حاضر</span>
                    @elseif($attendance->status == 'late')
                        <span class="text-red-600 font-bold">
                            {{ $attendance->type_late == 'half_day' ? 'متأخر نص يوم' : 'متاخر يوم كامل' }}
                        </span>
                    @elseif($attendance->status == 'absent')
                        <span class="text-yellow-600 font-bold">غائب</span>
                    @elseif($attendance->status == 'on_leave')
                        <span class="text-yellow-600 font-bold">فى أجازة</span>
                    @endif
                </td>
                <td class="p-3">{{ $attendance->late_minutes . ' دقيقة' }}</td>
                <td class="p-3">
                    <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">حذف</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- زر إضافة جديد -->
    <div class="mt-6 flex items-center gap-6">
        <a href="{{ route('attendances.checkinPage') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
            تسجيل حضور موظف
        </a>
        <a href="{{ route('attendances.checkoutPage') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
            تسجيل إنصراف موظف
        </a>
    </div>
</div>
@endsection
