<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Slider;


class SlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        // Admin
        $slide = Slider::create([
            'id'=> 1,
            'title' => 'img lantai 1',
            'caption' => 'lantai1',
            'image' => '1706855996.jpg',
        ]);
        $slide = Slider::create([
            'id'=> 2,
            'title' => 'img lantai 2',
            'caption' => 'lantai 2',
            'image' => '1706844466.jpg',
        ]);
        $slide = Slider::create([
            'id'=> 3,
            'title' => 'img lantai 3',
            'caption' => 'lantai 3',
            'image' => '1706844476.jpg',
        ]);
    }
}
