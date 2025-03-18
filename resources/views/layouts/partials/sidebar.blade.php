<aside id="sidebar" class="fixed top-18 right-0 w-64 min-h-screen p-4 bg-gray-800 text-white shadow-lg transform translate-x-full lg:translate-x-0 lg:relative transition-transform duration-200 ease-in-out z-50">
    <ul class="p-4">
        <li class="mb-4 active">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 hover:bg-gray-700 p-2 rounded">
                <span class="material-icons">home</span> الرئيسية
            </a>
        </li>
        <li class="mb-4">
            <a href="{{ route('departments.index') }}" class="flex items-center gap-2 hover:bg-gray-700 p-2 rounded">
                <span class="material-icons">business</span>  إدارة الأقسام
            </a>
        </li>
        <li class="mb-4">
            <a href="{{ route('shifts.index') }}" class="flex items-center gap-2 hover:bg-gray-700 p-2 rounded">
                <span class="material-icons">schedule</span>  إدارة الورديات
            </a>
        </li>
        <li class="mb-4">
            <a href="{{ route('employees.index') }}" class="flex items-center gap-2 hover:bg-gray-700 p-2 rounded">
                <span class="material-icons">person</span> إدارة الموظفين
            </a>
        </li>
        {{-- <li class="mb-4">
            <a href="{{ route('attendances.index') }}" class="flex items-center gap-2 hover:bg-gray-700 p-2 rounded">
                <span class="material-icons">schedule</span> الحضور والانصراف
            </a>
        </li> --}}
        {{-- <li class="mb-4">
            <a href="{{ route('salaries.index') }}" class="flex items-center gap-2 hover:bg-gray-700 p-2 rounded">
                <span class="material-icons">money</span> كشف المرتبات
            </a>
        </li> --}}
        {{-- <li class="mb-4">
            <a href="{{ route('leaves.index') }}" class="flex items-center gap-2 hover:bg-gray-700 p-2 rounded">
                <span class="material-icons">today</span> كشف الإجازات
            </a>
        </li> --}}
        {{-- <li class="mb-4">
            <a href="{{ route('adjustments.index') }}" class="flex items-center gap-2 hover:bg-gray-700 p-2 rounded">
                <span class="material-icons">money_off</span> كشف الخصومات
            </a>
        </li> --}}
        {{-- <li class="mb-4">
            <a href="{{ route('adjustments.index') }}" class="flex items-center gap-2 hover:bg-gray-700 p-2 rounded">
                <span class="material-icons">money_off</span> كشف المكافآت
            </a>
        </li> --}}
        {{-- <li class="mb-4">
            <a href="{{ route('users.index') }}" class="flex items-center gap-2 hover:bg-gray-700 p-2 rounded">
                <span class="material-icons">people</span> إدارة المستخدمين
            </a>
        </li> --}}
        {{-- <li class="mb-4">
            <a href="{{ route('settings.index') }}" class="flex items-center gap-2 hover:bg-gray-700 p-2 rounded">
                <span class="material-icons">settings</span> الإعدادات
            </a>
        </li> --}}
    </ul>
</aside>
