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
            'code' => "A203",
            'name' => 'Djoeanda',
            'floor'=> 2,
            'capacity' => 100,
            'building' => 'A',
        ]);
        $room = Room::create([
            'code' => "A204",
            'name' => 'Al Biruni 1',
            'floor'=> 2,
            'capacity' => 50,
            'building' => 'A',
        ]);
        $room = Room::create([
            'code' => "A205",
            'name' => 'Al Biruni 2',
            'floor'=> 2,
            'capacity' => 35,
            'building' => 'A',
        ]);
        $room = Room::create([
            'code' => "A206",
            'name' => 'Al Fihriyah 1',
            'floor'=> 2,
            'capacity' => 30,
            'building' => 'A',
        ]);
        $room = Room::create([
            'code' => "A207",
            'name' => 'Al Fihriyah 2',
            'floor'=> 2,
            'capacity' => 28,
            'building' => 'A',
        ]);
        $room = Room::create([
            'code' => "A208",
            'name' => 'Al Khazini 1',
            'floor'=> 2,
            'capacity' => 36,
            'building' => 'A',
        ]);
        $room = Room::create([
            'code' => "A301",
            'name' => 'Habibie 1',
            'floor'=> 3,
            'capacity' => 62,
            'building' => 'A',
        ]);
        $room = Room::create([
            'code' => "A302",
            'name' => 'Habibie 2',
            'floor'=> 3,
            'capacity' => 60,
            'building' => 'A',
        ]);
        $room = Room::create([
            'code' => "A303",
            'name' => 'Sinan 1',
            'floor'=> 3,
            'capacity' => 20,
            'building' => 'A',
        ]);
        $room = Room::create([
            'code' => "A304",
            'name' => 'Sinan 2',
            'floor'=> 3,
            'capacity' => 28,
            'building' => 'A',
        ]);
        $room = Room::create([
            'code' => "A305",
            'name' => 'Sinan 3',
            'floor'=> 3,
            'capacity' => 28,
            'building' => 'A',
        ]);
        $room = Room::create([
            'code' => "B101",
            'name' => 'Al Battani',
            'floor'=> 1,
            'capacity' => 50,
            'building' => 'B',
        ]);
        $room = Room::create([
            'code' => "B301",
            'name' => 'Ar Razi 1',
            'floor'=> 3,
            'capacity' => 64,
            'building' => 'B',
        ]);
        $room = Room::create([
            'code' => "B302",
            'name' => 'Ar Razi 2',
            'floor'=> 3,
            'capacity' => 66,
            'building' => 'B',
        ]);
        $room = Room::create([
            'code' => "B303",
            'name' => 'Ad Dinawari 1',
            'floor'=> 3,
            'capacity' => 48,
            'building' => 'B',
        ]);
        $room = Room::create([
            'code' => "B304",
            'name' => 'Ad Dinawari 2',
            'floor'=> 3,
            'capacity' => 48,
            'building' => 'B',
        ]);
        $room = Room::create([
            'code' => "B305",
            'name' => 'Ar Rammah 1',
            'floor'=> 3,
            'capacity' => 32,
            'building' => 'B',
        ]);
        $room = Room::create([
            'code' => "B306",
            'name' => 'Ar Rammah 2',
            'floor'=> 3,
            'capacity' => 32,
            'building' => 'B',
        ]);
        $room = Room::create([
            'code' => "C101",
            'name' => 'Al Jazari 1',
            'floor'=> 1,
            'capacity' => 15,
            'building' => 'C',
        ]);
        $room = Room::create([
            'code' => "C102",
            'name' => 'Al Jazari 2',
            'floor'=> 1,
            'capacity' => 48,
            'building' => 'C',
        ]);
        $room = Room::create([
            'code' => "C103",
            'name' => 'Al Jazari 3',
            'floor'=> 1,
            'capacity' => 36,
            'building' => 'C',
        ]);
        $room = Room::create([
            'code' => "C201",
            'name' => 'Ibnu Firnas',
            'floor'=> 2,
            'capacity' => 29,
            'building' => 'C',
        ]);
        $room = Room::create([
            'code' => "C202",
            'name' => 'Banu Musa 1',
            'floor'=> 2,
            'capacity' => 32,
            'building' => 'C',
        ]);
        $room = Room::create([
            'code' => "C203",
            'name' => 'Banu Musa 2',
            'floor'=> 2,
            'capacity' => 30,
            'building' => 'C',
        ]);
        $room = Room::create([
            'code' => "C204",
            'name' => 'Banu Musa 3',
            'floor'=> 2,
            'capacity' => 30,
            'building' => 'C',
        ]);
        $room = Room::create([
            'code' => "D201",
            'name' => 'Al Karaji 1',
            'floor'=> 2,
            'capacity' => 32,
            'building' => 'D',
        ]);
        $room = Room::create([
            'code' => "D202",
            'name' => 'Al Karaji 2',
            'floor'=> 2,
            'capacity' => 36,
            'building' => 'D',
        ]);
        $room = Room::create([
            'code' => "D203",
            'name' => 'Ibnu Rusyd 1',
            'floor'=> 2,
            'capacity' => 33,
            'building' => 'D',
        ]);
        $room = Room::create([
            'code' => "D303",
            'name' => 'Al Khawarizmi 1',
            'floor'=> 3,
            'capacity' => 29,
            'building' => 'D',
        ]);
        $room = Room::create([
            'code' => "D304",
            'name' => 'Al Khawarizmi 2',
            'floor'=> 3,
            'capacity' => 36,
            'building' => 'D',
        ]);
        $room = Room::create([
            'code' => "D305",
            'name' => 'Ibnu Rusyd 2',
            'floor'=> 3,
            'capacity' => 33,
            'building' => 'D',
        ]);
        $room = Room::create([
            'code' => "D306",
            'name' => 'Al Khayyam 1',
            'floor'=> 3,
            'capacity' => 31,
            'building' => 'D',
        ]);
        $room = Room::create([
            'code' => "D307",
            'name' => 'Al Khayyam 2',
            'floor'=> 3,
            'capacity' => 31,
            'building' => 'D',
        ]);
        $room = Room::create([
            'code' => "D308",
            'name' => 'Al Haytsam 1',
            'floor'=> 3,
            'capacity' => 35,
            'building' => 'D',
        ]);
        $room = Room::create([
            'code' => "D309",
            'name' => 'Al Haytsam 2',
            'floor'=> 3,
            'capacity' => 36,
            'building' => 'D',
        ]);
    }
}
