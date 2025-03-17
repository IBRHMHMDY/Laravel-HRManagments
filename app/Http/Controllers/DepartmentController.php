<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search'); // التقاط قيمة البحث

        $departments = Department::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->get();

        $deletedDepartments = Department::onlyTrashed()->get();
        return view('departments.index', compact('departments','deletedDepartments', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // التحقق من البيانات
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:departments,name',
        ]);

        // الحفظ
        Department::create($validated);

        // رسالة نجاح
        return redirect()->route('departments.index')->with('success', 'تم إضافة القسم بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
         // التحقق من البيانات
         $validated = $request->validate([
            'name' => 'required|string|max:255|unique:departments,name,' . $department->id,
        ]);

        // التحديث
        $department->update($validated);

        // رسالة نجاح
        return redirect()->route('departments.index')->with('success', 'تم تعديل القسم بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        // رسالة نجاح
        return redirect()->route('departments.index')->with('success', 'تم حذف القسم بنجاح!');

    }

    public function restore($id)
    {
        $department = Department::withTrashed()->find($id);

        if (!$department) {
            return redirect()->route('departments.index')->with('error', 'القسم غير موجود!');
        }

        if ($department->trashed()) {
            $department->restore();
            return redirect()->route('departments.index')->with('success', 'تم استعادة القسم بنجاح!');
        }

        return redirect()->route('departments.index')->with('error', 'القسم غير محذوف.');
    }

}
