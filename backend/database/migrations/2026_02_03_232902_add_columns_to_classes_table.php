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
        // classesテーブルを新規作成する
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('class_name')->comment('クラス名');
            $table->string('floor')->nullable()->comment('フロア');
            $table->integer('capacity')->default(0)->comment('最大座席数');
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