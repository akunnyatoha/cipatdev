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

        //Dekan
        Role::create([
            'name' => 'dekan',
        ]);

        //Perkuliahan
        Role::create([
            'name' => 'perkuliahan',
        ]);

        //Rumah Tangga
        Role::create([
            'name' => 'rumah tangga',
        ]);

        //User
        Role::create([
            'name' => 'user',
        ]);
    }
}
