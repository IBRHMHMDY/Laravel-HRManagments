<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShiftAttendance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'employee_id', 'shift_name', 'start_time', 'end_time', 'hours',
        'date', 'check_in', 'check_out', 'status', 'leave_type', 'approved_by'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    // حساب عدد الساعات تلقائياً
    public function getTotalHoursAttribute()
    {
        if (!$this->check_out) {
            return 0; // إذا لم يتم تسجيل وقت الخروج بعد
        }

        $checkIn = Carbon::parse($this->check_in);
        $checkOut = Carbon::parse($this->check_out);

        return $checkIn->diffInHours($checkOut); // حساب الفرق بالساعات
    }

    public function approvedBy()
    {
        return $this->belongsTo(Employee::class, 'approved_by');
    }

}
