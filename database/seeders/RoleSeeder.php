<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data  = [
            [
                "key" =>  "developer",
                "value" => "Developer",
            ],
            [
                "key" =>  "admin",
                "value" => "Admin",
            ],
            [
                "key" =>  "viewer",
                "value" => "Viewer",
            ],
        ];
        foreach($data as $key => $value){
            $data[$key]["creator_id"] = Auth::user() ?  Auth::user()->id : 1;
            $data[$key]["created_at"] = now();
        }
        //  dd($data);
        DB::table('roles')->insert($data);
    }
}
