<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LaratrustSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(FirstsliderSeeder::class);     
        $this->call(SocialmediaSeeder::class);  
        $this->call(ContectinfSeeder::class);
        $this->call(CategorySeeder::class);  
        $this->call(ProductSeeder::class);                   
    }
}
