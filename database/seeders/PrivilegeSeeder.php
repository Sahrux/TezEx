<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PrivilegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data  = [
                    [
                        "key" =>  "show_admins",
                        "value" => "Show admins",
                    ],
                    [
                        "key" =>  "show_customers",
                        "value" => "Show customers",
                    ],
                    [
                        "key" =>  "show_branches",
                        "value" => "Show branches",
                    ],
                    [
                        "key" =>  "show_packages",
                        "value" => "Show packs",
                    ],
                    [
                        "key" =>  "make_sorting",
                        "value" => "Make sorting",
                    ],
                    [
                        "key" =>  "show_sacks",
                        "value" => "Show sacks",
                    ],
                    [
                        "key" =>  "show_roles_n_privileges",
                        "value" => "Show roles & privileges",
                    ],
                    [
                        "key" =>  "add_roles",
                        "value" => "Add roles",
                    ],
                    [
                        "key" =>  "edit_roles",
                        "value" => "Edit roles",
                    ],
                    [
                        "key" =>  "delete_roles",
                        "value" => "Delete roles",
                    ],
                    [
                        "key" =>  "add_privileges",
                        "value" => "Add privileges",
                    ],
                    [
                        "key" =>  "edit_privileges",
                        "value" => "Edit privileges",
                    ],
                    [
                        "key" =>  "delete_privileges",
                        "value" => "Delete privileges",
                    ],
                ];
     foreach($data as $key => $value){
        $data[$key]["creator_id"] = Auth::user() ?  Auth::user()->id : 1;
        $data[$key]["created_at"] =  now();
     }
    //  dd($data);
     DB::table('privileges')->insert($data);

     

    }
}
