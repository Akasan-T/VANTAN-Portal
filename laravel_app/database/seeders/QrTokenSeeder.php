<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\QrToken;

class QrTokenSeeder extends Seeder
{
    public function run()
    {
        foreach (range(1, 10) as $i) {
            QrToken::create([
                'token' => Str::uuid(),
                'point' => rand(10, 50),
                'level' => rand(1, 3),
            ]);
        }
    }
}