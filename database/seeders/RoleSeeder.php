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
            'name' => 'Admin',
        ]);

        //Dekan
        Role::create([
            'name' => 'Dekan',
        ]);

        //Perkuliahan
        Role::create([
            'name' => 'Perkuliahan',
        ]);

        //BKA
        Role::create([
            'name' => 'BKA',
        ]);

        //User
        Role::create([
            'name' => 'Peminjam',
        ]);
    }
}
