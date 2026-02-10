<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Classes;
use App\Models\ClassSchedule;
use App\Models\Seat;
use Carbon\Carbon;

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
            'name' => 'テスト学生',
            'email' => 'student@test.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        $student = Student::create([
            'user_id' => $studentUser->id,
            'student_number' => 'S0001',
            'faculty' => '工学部',
            'department' => '情報工学科',
            'major' => 'ソフトウェア',
            'grade' => 2,
            'enrollment_year' => 2024,
            'status' => 'enrolled',
        ]);

        /*
        |--------------------------------------------------------------------------
        | 授業
        |--------------------------------------------------------------------------
        */
        $class = Classes::create([
            'teacher_id' => $teacher->id,
            'class_name' => 'Webアプリ開発',
            'department_name' => '情報工学科',
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
            'date' => Carbon::today(),
            'start_time' => '09:00',
            'end_time' => '10:30',
            'attendance_code' => 'TEST-QR-CODE',
            'code_expires_at' => Carbon::now()->addMinutes(15),
            'status' => 'open',
        ]);

        /*
        |--------------------------------------------------------------------------
        | 座席（seats）
        |--------------------------------------------------------------------------
        */
        // 仮に教室Aに 10席作る
        for ($i = 1; $i <= 10; $i++) {
            Seat::create([
                'room_name' => '教室A',
                'seat_code' => 'A'.$i,
            ]);
        }
    }
}
