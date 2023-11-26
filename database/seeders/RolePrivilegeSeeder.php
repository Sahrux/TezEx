<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePrivilegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_privs  = [
            1 => [1,2,3,4,5,6,7,8,9,10,11,12],
            2 => [1,2,3,4,5,6],
            3 => [1,2,3,4]
        ];

        $data = [];
        foreach($role_privs as $key => $item){
            foreach($item as $sub_key => $sub_item){
                $data[] = [
                    "role_id" => $key,
                    "privilege_id" => $sub_item,
                    "creator_id" => Auth::user() ?  Auth::user()->id : 1,
                    "created_at" => now(),
                ];
            }
        }

        //    dd($data);
          DB::table('role_privileges')->insert($data);
    }
}
