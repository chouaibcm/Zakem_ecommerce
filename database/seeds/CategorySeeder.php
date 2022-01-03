<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $first=Category::create([
            'name'=>'My Products',
            'status'=> 1,
        ]);
    }
}
