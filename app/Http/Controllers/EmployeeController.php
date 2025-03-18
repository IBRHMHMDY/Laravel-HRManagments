<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Shift;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with(['department', 'shift'])->get();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        $shifts = Shift::all();
        return view('employees.create', compact('departments', 'shifts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'          => 'required|string|max:255',
            'phone'         => 'required|string|max:15',
            'email'         => 'required|email|unique:employees,email',
            'address'       => 'nullable|string|max:500',
            'birth_date'    => 'required|date',
            'join_date'     => 'required|date',
            'department_id' => 'required|exists:departments,id',
            'shift_id'      => 'nullable|exists:shifts,id',
            'salary_type'   => 'required|in:fixed,hourly',
            'fixed_salary'  => 'nullable|numeric|required_if:salary_type,fixed',
            'hourly_rate'   => 'nullable|numeric|required_if:salary_type,hourly',
        ]);

        Employee::create($request->all());
        return redirect()->route('employees.index')->with('success', 'تمت إضافة الموظف بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $departments = Department::all();
        $shifts = Shift::all();
        return view('employees.edit', compact('employee', 'departments', 'shifts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'phone'         => 'required|string|max:15',
            'email'         => 'required|email|unique:employees,email,' . $employee->id,
            'address'       => 'nullable|string|max:500',
            'birth_date'    => 'required|date',
            'join_date'     => 'required|date',
            'department_id' => 'required|exists:departments,id',
            'shift_id'      => 'nullable|exists:shifts,id',
            'salary_type'   => 'required|in:fixed,hourly',
            'fixed_salary'  => 'nullable|numeric|required_if:salary_type,fixed',
            'hourly_rate'   => 'nullable|numeric|required_if:salary_type,hourly',
        ]);

        $employee->update($request->all());
        return redirect()->route('employees.index')->with('success', 'تم تحديث بيانات الموظف بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'تم حذف الموظف بنجاح');
    }
}
