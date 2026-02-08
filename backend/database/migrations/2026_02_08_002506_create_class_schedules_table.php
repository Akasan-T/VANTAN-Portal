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
        Schema::create('class_schedules', function (Blueprint $table) {
            $table->id(); // 授業回ID
            $table->foreignId('class_id') // classesに紐付け
                  ->constrained()
                  ->cascadeOnDelete();    // class_id削除時に同時削除
            $table->date('date');         // 授業日
            $table->time('start_time');   // 開始時刻
            $table->time('end_time');     // 終了時刻
            $table->string('attendance_code');   // 出席用QRコード
            $table->dateTime('code_expires_at'); // QR有効期限
            $table->enum('status', [
                            'open',    // 出席受付中
                            'closed',  // 終了
                            'canceled' // 休講
                        ])->default('open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_schedules');
    }
};
