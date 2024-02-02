<?php

namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         //Admin
         Role::create([
            'name' => 'admin',
        ]);

        //Staff
        Role::create([
            'name' => 'staff',
        ]);

        //User
        Role::create([
            'name' => 'user',
        ]);
    }
}
