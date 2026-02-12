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
        Schema::create('seats', function (Blueprint $table) {
            $table->id(); // 座席ID
            $table->foreignId('room_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->string('seat_code'); // 座席番号
            $table->timestamps();

            $table->unique(['room_id', 'seat_code']); // 同じ教室で同じ席番号禁止
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};
