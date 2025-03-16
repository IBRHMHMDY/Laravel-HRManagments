<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'phone', 'email', 'address', 'birth_date', 'join_date',
        'department_id', 'salary_type', 'fixed_salary', 'hourly_rate'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function shiftAttendances()
    {
        return $this->hasMany(ShiftAttendance::class);
    }

    public function adjustments()
    {
        return $this->hasMany(Adjustment::class);
    }

    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }

    public function approvedShifts()
    {
        return $this->hasMany(ShiftAttendance::class, 'approved_by');
    }

}
