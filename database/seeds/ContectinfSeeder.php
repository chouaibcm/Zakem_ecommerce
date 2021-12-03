<?php

use App\Contactinf;
use Illuminate\Database\Seeder;

class ContectinfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $first= Contactinf::create([            
            'address'=> 'Street - Town - State - Country',            
            'phone'=> '+1237908098 / +3221901802',            
            'email'=> 'example@example.com',            
            'logo1'=> 'logo.png',            
            'logo2'=> 'logo1.png',
        ]);
    }
}
