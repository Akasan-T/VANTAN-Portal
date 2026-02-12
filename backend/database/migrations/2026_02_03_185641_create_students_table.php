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
        Schema::create('students', function (Blueprint $table) {
            $table->id(); // 学生ID
            $table->foreignId('user_id') // usersと紐付け
                  ->constrained()
                  ->cascadeOnDelete();   // user_id削除自動時に削除
            $table->string('student_number')->unique(); // 学籍番号
            $table->string('faculty');     // 学部
            $table->string('department');  // 学科名
            $table->string('major');       // 専攻
            $table->unsignedTinyInteger('grade');      // 学年
            $table->integer('enrollment_year'); // 入学年度
            $table->enum('status',[
                            'enrolled', // 在学
                            'on_leave', // 休学
                            'expelled', // 除籍
                            'graduated' // 卒業
                        ]);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
