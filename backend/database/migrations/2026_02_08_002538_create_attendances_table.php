<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id(); // 出席ID
            $table->foreignId('student_id') // studentsと紐付け
                  ->constrained()
                  ->restrictOnDelete();

            $table->foreignId('class_schedule_id') // class_schedulesと紐付け
                  ->constrained()
                  ->restrictOnDelete();
                
            $table->foreignId('seat_id') // seatsと紐付け
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();
                
            $table->enum('status', [
                'present',     // 出席
                'late',        // 遅刻
                'early_leave', // 早退
                'absent',      // 欠席
                'excused'      // 公欠
            ]);

            $table->enum('attendance_method', [
                'qr',      // QR出席
                'manual',  // 手動入力
                'admin'    // 管理者操作
            ]);

            $table->dateTime('checked_in_at')->nullable(); // 出席時刻
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
