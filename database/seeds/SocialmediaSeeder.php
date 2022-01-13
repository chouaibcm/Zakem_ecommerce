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
            'facebook'=> 'www.facebook.com',            
            'instagram'=> 'www.instagram.com',            
            'google'=> '',            
            'twitter'=> 'www.twitter.com',            
            'pinterest'=> '',            
            'youtube'=> '',
        ]);
    }
}
