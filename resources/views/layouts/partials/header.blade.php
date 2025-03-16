<nav class="bg-gray-800 p-4 flex justify-between items-center text-white">
    <button id="sidebar-toggle" class="lg:hidden text-gray-600">
        <i class="material-icons">menu</i>
    </button>

    <h2 class="text-gray-200 text-3xl font-extrabold">نظام إدارة الموظفين</h2>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">تسجيل الخروج</button>
    </form>

</nav>

<script>
    // زر إظهار وإخفاء الشريط الجانبي
document.getElementById('sidebar-toggle').addEventListener('click', function() {
    let sidebar = document.getElementById('sidebar');
    if (sidebar.classList.contains('translate-x-full')) {
        sidebar.classList.remove('translate-x-full');
    } else {
        sidebar.classList.add('translate-x-full');
    }
});
</script>
