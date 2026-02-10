<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\ClassSchedule;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function check(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $student = auth()->user()->student;

        $schedule = ClassSchedule::where('attendance_code', $request->code)
            ->where('status', 'open')
            ->firstOrFail();

        // QRコード有効期限チェック
        if (now()->gt($schedule->code_expires_at)) {
            return response()->json([
                'message' => '出席受付時間外です'
            ], 403);
        }

        // 二重出席防止 
        $exists = Attendance::where('student_id', $student->id)
            ->where('class_schedule_id', $schedule->id)
            ->exists();
        
        if ($exists) {
            return response()->json([
                'message' => 'すでに出席済みです'
            ], 409);
        }

        Attendance::create([
            'student_id' => $student->id,
            'class_schedule_id' => $schedule->id,
            'status' => 'present',
            'attendance_method' => 'qr',
            'checked_in_at' => now(),
        ]);

        return response()->json([
            'message' => '出席を記録しました'
        ]);
    }
}
