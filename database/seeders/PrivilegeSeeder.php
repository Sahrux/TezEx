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
                        "value" => "Adminləri görmək",
                    ],
                    [
                        "key" =>  "show_customers",
                        "value" => "Müştəriləri görmək",
                    ],
                    [
                        "key" =>  "show_branches",
                        "value" => "Filialları görmək",
                    ],
                    [
                        "key" =>  "show_packages",
                        "value" => "Bağlamaları görmək",
                    ],
                    [
                        "key" =>  "show_roles",
                        "value" => "Rolları görmək",
                    ],
                    [
                        "key" =>  "edit_roles",
                        "value" => "Rolları dəyişmək",
                    ],
                    [
                        "key" =>  "make_sorting",
                        "value" => "Çeşidləmə etmək",
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
