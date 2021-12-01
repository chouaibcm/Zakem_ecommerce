<?php

use App\Socialmedia;
use Illuminate\Database\Seeder;

class SocialmediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $first= Socialmedia::create([            
            'facebook'=> '',            
            'instagram'=> '',            
            'google'=> '',            
            'twitter'=> '',            
            'pinterest'=> '',            
            'youtube'=> '',
        ]);
    }
}
