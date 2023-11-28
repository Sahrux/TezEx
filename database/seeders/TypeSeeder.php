<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "key" => "fragile",
                "value" => "Fragile",
                "created_at" => now()
            ],
            [
                "key" => "flammable",
                "value" => "Flammable",
                "created_at" => now()
            ],
            [
                "key" => "liquid",
                "value" => "Liquid",
                "created_at" => now()
            ],
            [
                "key" => "other",
                "value" => "Other",
                "created_at" => now()
            ],
        ];

        DB::table('types')->insert($data);

    }
}
