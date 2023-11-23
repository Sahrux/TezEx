<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "name" => "Insaatcilar",
                "address" => "Yasamal r,Şərifzadə k.",
                "status" => "1",
                "created_at" => now()
            ],
            [
                "name" => "Rəcəbli",
                "address" => "Nərimanov r,Aşıq molla cümə k.",
                "status" => "0",
                "created_at" => now()
            ],
            [
                "name" => "Yeni Yasamal",
                "address" => "Yasamal r,Dadaş Bünyadzadə k.",
                "status" => "1",
                "created_at" => now()
            ]
        ];

        DB::table('branches')->insert($data);

    }
}
