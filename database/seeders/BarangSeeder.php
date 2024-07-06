<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        // for ($i=0; $i < 50 ; $i++) {
        //     $room = Barang::create([
        //         'id' => $faker->unique()->numberBetween($min = 100, $max = 200),
        //         'name' => $faker->word,
        //         'quantity' => 20
        //     ]);
        // }
        
        $barangs = Barang::create([
            'id' => $faker->unique()->numberBetween($min = 100, $max = 200),
            'name' => 'Laptop',
            'quantity' => 20
        ]);
        $barangs = Barang::create([
            'id' => $faker->unique()->numberBetween($min = 100, $max = 200),
            'name' => 'Mouse',
            'quantity' => 20
        ]);
        $barangs = Barang::create([
            'id' => $faker->unique()->numberBetween($min = 100, $max = 200),
            'name' => 'Keyboard',
            'quantity' => 20
        ]);
        $barangs = Barang::create([
            'id' => $faker->unique()->numberBetween($min = 100, $max = 200),
            'name' => 'Kabel Role',
            'quantity' => 20
        ]);
    }
}
