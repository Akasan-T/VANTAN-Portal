<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\ClassSchedule;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // QRチェック
    public function check(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $schedule = ClassSchedule::with(['class', 'room.seats'])
            ->where('attendance_code', $request->code)
            ->where('status', 'open')
            ->where('code_expires_at', '>=', now())
            ->first();

        if (!$schedule) {
            return response()->json([
                'message' => '有効な授業が見つかりません'
            ], 404);
        }

        $takenSeatIds = Attendance::where('class_schedule_id', $schedule->id)
            ->pluck('seat_id');

        $seats = $schedule->room->seats->map(function ($seat) use ($takenSeatIds) {
            return [
                'id' => $seat->id,
                'seat_code' => $seat->seat_code,
                'is_taken' => $takenSeatIds->contains($seat->id),
            ];
        });

        return response()->json([
            'schedule_id' => $schedule->id,
            'class_name' => $schedule->class->class_name,
            'room_name' => $schedule->room->room_name,
            'date' => $schedule->date,
            'start_time' => $schedule->start_time,
            'end_time' => $schedule->end_time,
            'seats' => $seats,
        ]);
    }

    // 出席者チェック
    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:class_schedules,id',
            'seat_id' => 'required|exists:seats,id',
        ]);

        $student = auth()->user()->student;

        Attendance::create([
            'student_id' => $student->id,
            'class_schedule_id' => $request->schedule_id,
            'seat_id' => $request->seat_id,
            'status' => 'present',
            'attendance_method' => 'qr',
            'checked_in_at' => now(),
        ]);

        return response()->json([
            'message' => '出席を記録しました'
        ]);
    }

    // 当日出席状況
    public function today()
    {
        $student = auth()->user()->student;

        $attendances = Attendance::with(['schedule.class', 'schedule.room', 'seat'])
            ->where('student_id', $student->id)
            ->whereHas('schedule', function ($query) {
                $query->whereDate('date', now()->toDateString());
            })
            ->get()
            ->map(function ($attendance) {
                return [
                    'class_name' => $attendance->schedule->class->class_name,
                    'room_name' => $attendance->room->room_name,
                    'seat_code' => $attendance->seat->seat_code,
                    'date' => $attendance->schedule->date,
                    'status' => $attendance->status,
                ];
            });
        
            return response()->json($attendances);
    }
}
