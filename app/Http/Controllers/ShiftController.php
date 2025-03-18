<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shifts = Shift::all();
        return view('shifts.index', compact('shifts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shifts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
        ], [
            'start_time.required' => 'يرجى إدخال وقت بداية الشفت.',
            'end_time.required' => 'يرجى إدخال وقت نهاية الشفت.',
        ]);

        $start = Carbon::createFromFormat('H:i', $request->start_time);
        $end = Carbon::createFromFormat('H:i', $request->end_time);

        if ($end < $start) {
            $end->addDay(); // معالجة حالة عبور منتصف الليل
        }

        $hoursWorks = $start->diff($end)->format('%H:%I'); // حساب الفرق بالساعات والدقائق

        Shift::create([
            'name' => $request->name,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'hours_works' => $hoursWorks,
        ]);

        return redirect()->route('shifts.index')->with('success', 'تم إضافة الشفت بنجاح!');
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
    public function edit(Shift $shift)
    {
        return view('shifts.edit', compact('shift'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shift $shift)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
        ], [
            'start_time.required' => 'يرجى إدخال وقت بداية الشفت.',
            'end_time.required' => 'يرجى إدخال وقت نهاية الشفت.',
        ]);

        $start = Carbon::createFromFormat('H:i', $request->start_time);
        $end = Carbon::createFromFormat('H:i', $request->end_time);

        if ($end < $start) {
            $end->addDay(); // معالجة حالة عبور منتصف الليل
        }

        $hoursWorks = $start->diff($end)->format('%H:%I');

        $shift->update([
            'name' => $request->name,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'hours_works' => $hoursWorks,
        ]);

        return redirect()->route('shifts.index')->with('success', 'تم تحديث الشفت بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shift $shift)
    {
        $shift->delete();
        return redirect()->route('shifts.index')->with('Success','تم حذف الشيفت');
    }

}
