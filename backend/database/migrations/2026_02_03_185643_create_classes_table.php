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
        Schema::create('classes', function (Blueprint $table) {
            $table->id(); // 授業ID
            $table->foreignId('teacher_id') // 担当講師
                    ->nullable()
                    ->constrained('teachers')
                    ->cascadeOnDelete();      // teacher_id削除時に同時削除
            $table->string('class_name');   // 授業名
            $table->string('department_name'); // 対象学科
            $table->integer('grade');       // 対象学年
            $table->integer('school_year'); // 実施年度
            $table->enum('term', [
                            'first',  // 前期
                            'second', // 後期
                            'year'    // 通年
                        ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
