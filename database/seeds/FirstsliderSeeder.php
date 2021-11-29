<?php

use App\FirstSlider;
use Illuminate\Database\Seeder;

class FirstsliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $first= FirstSlider::create([
            'heading'=> 'Heading one',
            'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni, quas?',
            'image'=> 'image1.jpg',
        ]);
        $first2= FirstSlider::create([
            'heading'=> 'Heading two',
            'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni, quas?',
            'image'=> 'image2.jpg',
        ]);
        $first2= FirstSlider::create([
            'heading'=> 'Heading three',
            'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni, quas?',
            'image'=> 'image3.jpg',
        ]);
    }
}
