<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salary extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['employee_id', 'month', 'base_salary', 'overtime_pay'];

    protected $appends = ['total_salary'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function getTotalSalaryAttribute()
    {
        $bonuses = Adjustment::where('employee_id', $this->employee_id)
            ->where('type', 'bonus')
            ->whereMonth('date', now()->month)
            ->sum('amount');

        $deductions = Adjustment::where('employee_id', $this->employee_id)
            ->where('type', 'deduction')
            ->whereMonth('date', now()->month)
            ->sum('amount');

        return $this->base_salary + $this->overtime_pay + $bonuses - $deductions;
    }

}
