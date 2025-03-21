<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'shift_id', 'shift_name', 'start_time', 'end_time', 'hours',
        'date', 'check_in', 'check_out', 'status', 'leave_type', 'approved_by'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function shift(){
        return $this->belongsTo(Shift::class);
    }

    // حساب عدد الساعات تلقائياً
    public function getTotalHours()
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
