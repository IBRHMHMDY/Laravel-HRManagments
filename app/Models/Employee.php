<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'phone', 'email', 'address', 'birth_date', 'join_date',
        'department_id', 'shift_id', 'salary_type', 'fixed_salary', 'hourly_rate'
    ];

    protected $attributes = [
        'fixed_salary' => 0,
        'hourly_rate' => 0,
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function Attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    public function shift()
    {
        return $this->belongsTo(Shift::class);
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
        return $this->hasMany(Attendance::class, 'approved_by');
    }

}
