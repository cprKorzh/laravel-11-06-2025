<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FurnitureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('furnitures')->insert([
            [
                'title' => 'Табурет',
                'price' => 1500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Стул',
                'price' => 2500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Кресло',
                'price' => 5000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Диван',
                'price' => 10000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
