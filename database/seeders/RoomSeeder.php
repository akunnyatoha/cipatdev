<?php

namespace Database\Seeders;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        // for ($i=0; $i < 50 ; $i++) {
        //     $room = Room::create([
        //         'id' => $faker->unique()->numberBetween($min = 100, $max = 200),
        //         'name' => $faker->word,
        //         'floor'=> $faker->numberBetween($min = 1, $max = 3),
        //         'capacity' => $faker->numberBetween($min = 30, $max = 100),
        //         'building' => 'FTUMJ',
        //     ]);
        // }
        $room = Room::create([
            'id' => 1,
            'code' => "A0001",
            'name' => 'Jasmin',
            'floor'=> 1,
            'capacity' => $faker->numberBetween($min = 30, $max = 100),
            'building' => 'FTUMJ',
        ]);
        $room = Room::create([
            'id' => 2,
            'code' => "A0002",
            'name' => 'Melati',
            'floor'=> 1,
            'capacity' => $faker->numberBetween($min = 30, $max = 100),
            'building' => 'FTUMJ',
        ]);
        $room = Room::create([
            'id' => 3,
            'code' => "A0003",
            'name' => 'Anggrek',
            'floor'=> 1,
            'capacity' => $faker->numberBetween($min = 30, $max = 100),
            'building' => 'FTUMJ',
        ]);
        $room = Room::create([
            'id' => 4,
            'code' => "A0004",
            'name' => 'Dahlia',
            'floor'=> 2,
            'capacity' => $faker->numberBetween($min = 30, $max = 100),
            'building' => 'FTUMJ',
        ]);
        $room = Room::create([
            'id' => 5,
            'code' => "A0005",
            'name' => 'Aster',
            'floor'=> 2,
            'capacity' => $faker->numberBetween($min = 30, $max = 100),
            'building' => 'FTUMJ',
        ]);
        $room = Room::create([
            'id' => 6,
            'code' => "A0006",
            'name' => 'Sakura',
            'floor'=> 2,
            'capacity' => $faker->numberBetween($min = 30, $max = 100),
            'building' => 'FTUMJ',
        ]);
    }
}
