<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'shift_id', 'hours_works', 'date',
        'check_in', 'late_minutes', 'check_out', 'status', 'type_late',
        'overtime_minutes', 'early_leave_minutes', 'leave_type'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function shift(){
        return $this->belongsTo(Shift::class);
    }

    // // حساب عدد الساعات تلقائياً
    // public function getTotalHours()
    // {
    //     if (!$this->check_out) {
    //         return 0; // إذا لم يتم تسجيل وقت الخروج بعد
    //     }

    //     $checkIn = Carbon::parse($this->check_in);
    //     $checkOut = Carbon::parse($this->check_out);

    //     return $checkIn->diffInHours($checkOut); // حساب الفرق بالساعات
    // }

    public function approvedBy()
    {
        return $this->belongsTo(Employee::class, 'approved_by');
    }

}
