<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\ClassSchedule;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;

/**
 *  学生用の出席API
 *  check == QRコードチェック
 *  store == 出席登録
 *  today == 今日の出席状況取得
 **/
class AttendanceController extends Controller
{
    // QRコードチェック処理
    public function check(Request $request)
    {
        // バリデーション
        $request->validate([
            'code' => 'required|string',
        ]);

        // 有効な授業を探す(QR一致・授業開講中・QR有効期限判定)
        $schedule = ClassSchedule::with(['class', 'room.seats'])
            ->where('attendance_code', $request->code)
            ->where('status', 'open')
            ->where('code_expires_at', '>=', now())
            ->first();

        // コードは存在するけど有効期限切れ
        $schedule = ClassSchedule::where('attendance_code', $request->code)
            ->first();
        
        if (!$schedule) {
            return response()->json([
                'message' => '授業が存在しません'
            ], 404);
        }

        // 授業状況 or 有効期限チェック
        if ($schedule->status !== 'open') {
            return response()->json([
                'message' => 'この授業は受付終了しています',
                'expired' => true
            ], 400);
        }

        if ($schedule->code_expires_at < now()) {
            return response()->json([
                'message' => 'QRコードの有効期限が切れています',
                'expired' => true
            ], 400);
        }

        $student = auth()->user()->student;

        // ログイン中のユーザーが該当する授業に出席しているかチェック
        $already = Attendance::where('student_id', $student->id)
            ->where('class_schedule_id', $schedule->id)
            ->exists();

        // 出席済みエラー
        if ($already) {
            return response()->json([
                'already_attended' => true,
                'message' => '既に出席済みです'
            ]);
        }

        // 座席の使用状況取得
        $takenSeatIds = Attendance::where('class_schedule_id', $schedule->id)
            ->pluck('seat_id');

        // 座席一覧を整形
        $seats = $schedule->room->seats->map(function ($seat) use ($takenSeatIds) {
            return [
                'id' => $seat->id,
                'seat_code' => $seat->seat_code,
                'is_taken' => $takenSeatIds->contains($seat->id),
            ];
        });

        // レスポンス
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

    // 出席登録処理
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'schedule_id' => 'required|exists:class_schedules,id',
            'seat_id' => 'required|exists:seats,id',
        ]);

        $student = auth()->user()->student;

        // 出席済みチェック
        $exists = Attendance::where('student_id', $student->id)
            ->where('class_schedule_id', $request->schedule_id)
            ->exists();

        if ($exists) {
            return response()->json([
                'already_attended' => true,
                'message' => '既に出席済みです'
            ], 200);
        }

        // 出席登録
        Attendance::create([
            'student_id' => $student->id,
            'class_schedule_id' => $request->schedule_id,
            'seat_id' => $request->seat_id,
            'status' => 'present',
            'attendance_method' => 'qr',
            'checked_in_at' => now(),
        ]);

        // 成功時レスポンス
        return response()->json([
            'success' => true
        ]);
    }


    // 当日の出席状況
    public function today()
    {
        $student = auth()->user()->student;

        // 今日の授業のみ取得
        $attendances = Attendance::with(['schedule.class', 'schedule.room', 'seat'])
            ->where('student_id', $student->id)
            ->whereHas('schedule', function ($query) {
                $query->whereDate('date', now()->toDateString());
            })
            ->get()
            ->map(function ($attendance) {
                $schedule = $attendance->schedule;

                    // 時間を "13:00〜17:00" の形式に整形
                    $timeRange = $schedule->start_time && $schedule->end_time
                        ? date('H:i', strtotime($schedule->start_time)) . '〜' . date('H:i', strtotime($schedule->end_time))
                        : '';

                    return [
                        'status' => $attendance->status, // 出席など
                        'class_name' => $schedule->class->class_name, // 授業名
                        'time' => $timeRange, // 授業時間
                        'date' => date('Y/m/d', strtotime($schedule->date)), // 日付
                    ];
                });
                
            return response()->json($attendances);
    }
}
