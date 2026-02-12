<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Room;
use App\Models\Seat;
use App\Models\Classes;
use App\Models\ClassSchedule;
use App\Models\Attendance;

class DevAllSeeder extends Seeder
{
    public function run(): void
    {
        // 🔒 本番事故防止
        if (!app()->isLocal()) {
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | 講師ユーザー
        |--------------------------------------------------------------------------
        */
        $teacherUser = User::create([
            'name' => 'テスト講師',
            'email' => 'teacher@test.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
        ]);

        $teacher = Teacher::create([
            'user_id' => $teacherUser->id,
            'specialty' => '情報工学科',
        ]);

        /*
        |--------------------------------------------------------------------------
        | 学生ユーザー
        |--------------------------------------------------------------------------
        */
        $studentUser = User::create([
            'name' => 'テスト学生1',
            'email' => 'student1@test.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        $student = Student::create([
            'user_id' => $studentUser->id,
            'student_number' => 'S0001',
            'faculty' => 'KADOKAWAドワンゴ情報工科学院',
            'department' => '専門',
            'major' => 'システムエンジニア',
            'grade' => 2,
            'enrollment_year' => 2024,
            'status' => 'enrolled',
        ]);

        $studentUser = User::create([
            'name' => 'テスト学生2',
            'email' => 'student2@test.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        $student = Student::create([
            'user_id' => $studentUser->id,
            'student_number' => 'S0002',
            'faculty' => 'KADOKAWAドワンゴ情報工科学院',
            'department' => '専門',
            'major' => 'システムエンジニア',
            'grade' => 2,
            'enrollment_year' => 2024,
            'status' => 'enrolled',
        ]);

        /*
        |--------------------------------------------------------------------------
        | 教室
        |--------------------------------------------------------------------------
        */
        $room = Room::create([
            'room_name' => '402',
            'floor' => 4,
            'capacity' => 26,
        ]);

        /*
        |--------------------------------------------------------------------------
        | 座席
        |--------------------------------------------------------------------------
        */
        for ($i = 1; $i <= $room->capacity; $i++) {
            Seat::create([
                'room_id' => $room->id,
                'seat_code' => $i,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | 授業
        |--------------------------------------------------------------------------
        */
        $class = Classes::create([
            'teacher_id' => $teacher->id,
            'class_name' => 'PHP',
            'department_name' => '専門',
            'grade' => 2,
            'school_year' => 2025,
            'term' => 'first',
        ]);

        /*
        |--------------------------------------------------------------------------
        | 授業回（class_schedules）
        |--------------------------------------------------------------------------
        */
        $classSchedule = ClassSchedule::create([
            'class_id' => $class->id,
            'room_id' => $room->id, // ← これが今回の重要ポイント
            'date' => Carbon::today(),
            'start_time' => '09:30',
            'end_time' => '13:30',
            'attendance_code' => 'TEST-QR-CODE',
            'code_expires_at' => Carbon::now()->addMinutes(15),
            'status' => 'open',
        ]);

        /*
        |--------------------------------------------------------------------------
        | 出席データ（テスト）
        |--------------------------------------------------------------------------
        */
        Attendance::create([
            'student_id' => $student->id,
            'class_schedule_id' => $classSchedule->id,
            'seat_id' => 1, 
            'status' => 'present',
            'attendance_method' => 'qr',
            'checked_in_at' => now(),
        ]);
    }
}
