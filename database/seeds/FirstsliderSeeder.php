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
            'heading'=> ['ar'=>'العنوان الاول','en'=>'Heading one'],
            'description'=>['ar'=>'الوصف الاول','en'=>'description one'],
            'image'=> 'image1.jpg',
            'position'=> 'text-end',
        ]);
        $first2= FirstSlider::create([
            'heading'=> ['ar'=>'العنوان الثاني','en'=>'Heading two'],
            'description'=>['ar'=>'الوصف الثاني','en'=>'description two'],
            'image'=> 'image2.jpg',
            'position'=> 'text-start',
        ]);
        $first3= FirstSlider::create([
            'heading'=> ['ar'=>'العنوان الثالث','en'=>'Heading one'],
            'description'=>['ar'=>'الوصف الثالث','en'=>'description one'],
            'image'=> 'image3.jpg',            
            'position'=> '',
        ]);
    }
}
