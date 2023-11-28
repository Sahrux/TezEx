<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
                        PrivilegeSeeder::class,
                        RoleSeeder::class,
                        UserSeeder::class,
                        RolePrivilegeSeeder::class,
                        BranchSeeder::class,
                        TypeSeeder::class,
                        CategorySeeder::class,
                        PackSeeder::class,
                        CustomerSeeder::class,
                    ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
