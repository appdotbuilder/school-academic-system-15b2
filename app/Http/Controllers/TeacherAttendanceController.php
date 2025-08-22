<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherAttendanceRequest;
use App\Models\Teacher;
use App\Models\TeacherAttendance;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeacherAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TeacherAttendance::with('teacher');
        
        if ($request->has('teacher_id') && $request->teacher_id) {
            $query->where('teacher_id', $request->teacher_id);
        }
        
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('date', '>=', $request->date_from);
        }
        
        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('date', '<=', $request->date_to);
        }
        
        $attendances = $query->latest('date')->paginate(15);
        $teachers = Teacher::active()->select('id', 'first_name', 'last_name', 'employee_id')->get();
        
        return Inertia::render('attendances/index', [
            'attendances' => $attendances,
            'teachers' => $teachers,
            'filters' => $request->only(['teacher_id', 'date_from', 'date_to'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::active()->select('id', 'first_name', 'last_name', 'employee_id')->get();
        
        return Inertia::render('attendances/create', [
            'teachers' => $teachers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeacherAttendanceRequest $request)
    {
        // Check if attendance record already exists for this teacher and date
        $existingAttendance = TeacherAttendance::where('teacher_id', $request->teacher_id)
            ->where('date', $request->date)
            ->first();
            
        if ($existingAttendance) {
            return redirect()->back()
                ->withErrors(['date' => 'Attendance record already exists for this teacher on this date.']);
        }

        $attendance = TeacherAttendance::create($request->validated());

        return redirect()->route('attendances.show', $attendance)
            ->with('success', 'Attendance record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TeacherAttendance $attendance)
    {
        $attendance->load('teacher');
        
        return Inertia::render('attendances/show', [
            'attendance' => $attendance
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeacherAttendance $attendance)
    {
        $attendance->load('teacher');
        $teachers = Teacher::active()->select('id', 'first_name', 'last_name', 'employee_id')->get();
        
        return Inertia::render('attendances/edit', [
            'attendance' => $attendance,
            'teachers' => $teachers
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTeacherAttendanceRequest $request, TeacherAttendance $attendance)
    {
        // Check if attendance record already exists for this teacher and date (excluding current record)
        $existingAttendance = TeacherAttendance::where('teacher_id', $request->teacher_id)
            ->where('date', $request->date)
            ->where('id', '!=', $attendance->id)
            ->first();
            
        if ($existingAttendance) {
            return redirect()->back()
                ->withErrors(['date' => 'Attendance record already exists for this teacher on this date.']);
        }

        $attendance->update($request->validated());

        return redirect()->route('attendances.show', $attendance)
            ->with('success', 'Attendance record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TeacherAttendance $attendance)
    {
        $attendance->delete();

        return redirect()->route('attendances.index')
            ->with('success', 'Attendance record deleted successfully.');
    }
}