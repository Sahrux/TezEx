<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Factories\UserFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        foreach (["developer","admin","viewer"] as $key => $item) {
            $data[$key] = [
                "name" => ucfirst($item),
                "email" => "{$item}@gmail.com",
                'email_verified_at' => now(),
                "role_id" => $key + 1,
                "password" => Hash::make('123456'),
                "remember_token" => Str::random(10),
                "created_at" => now()
            ];
        }
        
       
       
        $faker = new UserFactory();

        for($i = 3;$i <= 15;$i++){

            $data[$i] = $faker->definition();
        }
        // $names = ["Harry","Ross","Bruce","Cook","Carolyn","Morgan","Albert","Walker","Randy","Reed","Larry","Barnes","Lois","Wilson","Jesse","Campbell","Ernest","Rogers","Theresa","Patterson","Henry","Simmons","Michelle","Perry","Frank","Butler","Shirley"];
        // foreach($names as $key => $name){
        //     $data[] = [
        //         "name" => $name,
        //         "email" => strtolower($name) . $key . "@gmail.com",
        //         // "role_id" => rand(2,3),
        //         "password" => password_hash("123456",PASSWORD_DEFAULT) 
        //     ];
        // }
        // dd($data);
        DB::table('users')->insert($data);
    }
}
