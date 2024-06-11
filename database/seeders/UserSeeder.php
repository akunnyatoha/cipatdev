<?php

namespace Database\Seeders;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        // Admin
        $user = User::create([
            'id'=> $faker->unique()->numberBetween($min = 100000, $max = 999999),
            'role_id' => 1,
            'name' => 'Admin',
            'email' => 'admin@email.test',
            'password' => Hash::make('password'),
            'phone' => $faker->phoneNumber,
        ]);

        // Dekan
        $user = User::create([
            'id'=> $faker->unique()->numberBetween($min = 100000, $max = 999999),
            'role_id' => 2,
            'name' => 'Dekan',
            'email' => 'dekan@email.test',
            'password' => Hash::make('password'),
            'phone' => $faker->phoneNumber,
        ]);
        // Dekan
        $user = User::create([
            'id'=> $faker->unique()->numberBetween($min = 100000, $max = 999999),
            'role_id' => 3,
            'name' => 'perkuliahan',
            'email' => 'perkuliahan@email.test',
            'password' => Hash::make('password'),
            'phone' => $faker->phoneNumber,
        ]);
        // Dekan
        $user = User::create([
            'id'=> $faker->unique()->numberBetween($min = 100000, $max = 999999),
            'role_id' => 4,
            'name' => 'Rumah Tangga',
            'email' => 'rumahtangga@email.test',
            'password' => Hash::make('password'),
            'phone' => $faker->phoneNumber,
        ]);

        // User
        for ($i=0; $i < 3 ; $i++) {
            $role = Role::inRandomOrder()->first();

            $user = User::create([
                'id'=> $faker->unique()->numberBetween($min = 100000, $max = 999999),
                'role_id' => 5,
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make('password'),
                'phone' => $faker->phoneNumber,
            ]);
        }
    }
}
