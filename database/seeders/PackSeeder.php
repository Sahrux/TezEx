<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    private function generateTrackingId(int $length = 8){
        $char_set = ["A","B","C","Z","0","1","2","3","4","5","6","7","8","9","D","K"];
        $res = "";
        for($i = 0;$i < $length;$i++){
            $res .= $char_set[rand(0,count($char_set) - 1)];
        }
        return $res;
    }

    public function run(): void
    {
        $data = [];

        for($i = 0;$i < 5;$i++){
            $data[] = [
                "tracking_id" => "TZ" . rand(1000,9999) . rand(1000,9999),
                "branch_id" => [1,3][rand(0,1)],
                "customer_id" => rand(1,26),
                "created_at" => now()
            ];
        }

        DB::table('packs')->insert($data);
       
    }
}
