<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "key" => "electronic",
                "value" => "Electronic",
                "type_id" => 1,
                "created_at" => now()
            ],
            [
                "key" => "parfume",
                "value" => "Parfume",
                "type_id" => 3,
                "created_at" => now()
            ],
            [
                "key" => "clothing",
                "value" => "Clothing",
                "type_id" => 4,
                "created_at" => now()
            ],
            [
                "key" => "other",
                "value" => "Other",
                "type_id" => 4,
                "created_at" => now()
            ],
        ];

        DB::table('categories')->insert($data);
    }
}
