<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendancesController extends Controller
{
    // حساب مدة التأخير بالدقائق
    function getLateMinutes($checkInTime, $shiftStartTime, $status) {
        if ($status !== 'late') {
            return 0;
        }

        // // تحويل القيم إلى كائنات Carbon
        $checkIn = Carbon::parse($checkInTime);
        // dd($checkIn);
        $shiftStart = Carbon::parse($shiftStartTime);
        // dd($shiftStart);

        // حساب دقائق التأخير فقط إذا كان الحضور متأخرًا
        if ($checkIn->greaterThan($shiftStart)) {
            return max(0, $checkIn->diffInMinutes($shiftStart, false));
        }

        return 0; // لا يوجد تأخير إذا حضر في الوقت أو قبله
    }


    // تحديد نوع التأخير
    function getTypeLate($lateMinutes) {
        if($lateMinutes >= 25  && $lateMinutes < 45){
            return 'half_day';
        }
        if($lateMinutes >= 45){
            return 'full_day';
        }
        if($lateMinutes < 25){
            return null;
        }
    }
    // حساب ساعات العمل الفعلية
    function getWorkingHours($checkInTime, $checkOutTime, $shiftStart, $shiftEnd) {
        $checkIn = Carbon::parse($checkInTime);
        $checkOut = Carbon::parse($checkOutTime);
        $shiftStart = Carbon::parse($shiftStart);
        $shiftEnd = Carbon::parse($shiftEnd);

        // التأكد من أن وقت الانصراف أكبر من وقت الحضور
        if ($checkOut->lessThanOrEqualTo($checkIn)) {
            return 0; // إذا كان وقت المغادرة غير صحيح، تكون ساعات العمل 0
        }

        // حساب وقت البداية الفعلي (الأخذ في الاعتبار الحضور المتأخر)
        $actualStart = $checkIn->greaterThan($shiftStart) ? $checkIn : $shiftStart;

        // حساب وقت النهاية الفعلي (الأخذ في الاعتبار المغادرة المبكرة)
        $actualEnd = $checkOut->lessThan($shiftEnd) ? $checkOut : $shiftEnd;

        // حساب فرق الساعات بين البداية الفعلية والنهاية الفعلية
        $workingHours = $actualEnd->diffInHours($actualStart);

        return $workingHours;
    }

    // حساب الساعات الإضافية
    function getOvertimeMinutes($checkOutTime, $shiftEnd) {
        // تحويل القيم إلى كائنات Carbon
        $checkOut = Carbon::parse($checkOutTime);
        $shiftEnd = Carbon::parse($shiftEnd);

        // حساب عدد الدقائق الإضافية فقط إذا كان الموظف غادر بعد انتهاء الدوام
        $overtimeMinutes = $checkOut->diffInMinutes($shiftEnd, false);

        // إذا كان الموظف غادر في الوقت أو قبله، تكون الإضافي 0 دقيقة
        return $overtimeMinutes > 0 ? $overtimeMinutes : 0;
    }
    // حساب دقائق المغادرة المبكرة
    function getEarlyLeaveMinutes($checkOutTime, $shiftEnd) {
        // تحويل القيم إلى كائنات Carbon
        $checkOut = Carbon::parse($checkOutTime);
        $shiftEnd = Carbon::parse($shiftEnd);

        // حساب عدد الدقائق المفقودة فقط إذا كان الموظف غادر قبل انتهاء الدوام
        $earlyLeaveMinutes = $shiftEnd->diffInMinutes($checkOut, false);

        // إذا كان الموظف غادر في الوقت أو بعده، تكون المغادرة المبكرة 0 دقيقة
        return $earlyLeaveMinutes > 0 ? $earlyLeaveMinutes : 0;
    }

    function setTimezone($time){
        return \Carbon\Carbon::parse($time)->setTimezone('Africa/Cairo')->format('H:i');
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $attendances = Attendance::with('employee', 'shift')->latest()->paginate(10);
        return view('attendances.index', compact('attendances'));
    }
    // Check in Page
    public function checkinPage() {
         $employees = Employee::all();
         $shifts = Shift::all();
        // جلب سجلات الحضور لعرضها في الجدول
        $attendances = Attendance::with('employee', 'shift')
            ->orderBy('date', 'desc')
            ->orderBy('check_in', 'desc')
            ->get();

        return view('attendances.checkin_page', compact('employees', 'shifts','attendances'));
    }
    // Check out Page
    public function checkoutPage() {
         $employees = Employee::all();
         $shifts = Shift::all();
         // جلب سجلات الحضور لعرضها في الجدول
        $attendances = Attendance::with('employee', 'shift')
        ->orderBy('date', 'desc')
        ->orderBy('check_out', 'desc')
        ->get();
        return view('attendances.checkout_page', compact('employees', 'shifts'));
    }

    public function checkIn(Request $request) {
        // التحقق من إدخال البيانات
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'shift_id' => 'required|exists:shifts,id',
            'status' => 'required|in:present,absent,on_leave,late',
        ]);

        // البحث عن الموظف والوردية
        $employee = Employee::find($request->employee_id);
        $shift = Shift::find($request->shift_id);

        // التحقق من تسجيل الحضور مسبقًا لنفس اليوم
        $alreadyCheckedIn = Attendance::where('employee_id', $employee->id)
            ->where('shift_id', $shift->id)
            ->whereDate('date', Carbon::today('Africa/Cairo'))
            ->exists();

        if ($alreadyCheckedIn) {
            return redirect()->route('attendances.index')->with('error', 'تم تسجيل الحضور مسبقًا لهذه الوردية');
        }

        // تحديد وقت الحضور وضبط المنطقة الزمنية
        $checkInTime = Carbon::now('Africa/Cairo');
        $shiftStartTime = Carbon::createFromFormat('H:i:s', $shift->start_time, 'Africa/Cairo');

        // حساب مدة التأخير إذا كان الموظف متأخرًا
        $lateMinutes = 0;
        $typeLate = null;
        if ($request->status === 'late' && $checkInTime->gt($shiftStartTime)) {
            $lateMinutes = $shiftStartTime->diffInMinutes($checkInTime,true);

            if ($lateMinutes >= 45) {
                $typeLate = 'full_day';
            } elseif ($lateMinutes >= 25) {
                $typeLate = 'half_day';
            }
        }

        // حفظ الحضور في قاعدة البيانات
        Attendance::create([
            'employee_id' => $employee->id,
            'shift_id' => $shift->id,
            'date' => Carbon::today('Africa/Cairo')->format('Y-m-d'),
            'check_in' => $checkInTime->format('H:i'),
            'late_minutes' => $lateMinutes,
            'type_late' => $typeLate,
            'status' => $request->status,
            'hours_works' => 0
        ]);

        return redirect()->route('attendances.index')->with('success', 'تم حفظ تسجيل الحضور بنجاح');
    }


    public function destroy(Attendance $attendance) {
        $attendance->delete();
        return redirect()->route('attendances.index')->with('success', 'تم حذف السجل بنجاح');
    }

}

    /**
     * حساب عدد ساعات العمل بين وقت الدخول والخروج
     */
    // private function getTotalHours($check_in, $check_out)
    // {
    //     if (!$check_out) return 0;
    //     return (strtotime($check_out) - strtotime($check_in)) / 3600;
    // }
