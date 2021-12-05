<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 8; $i++) { 
            $first = Product::create([
                'category_id'=>1,
                'title'=>'product '. $i .' title test',
                'name'=>'product '. $i .' name test',
                'p_code'=>'HSAKJHBDN2020',
                'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui, fuga.',
                'price'=>1999,
                'status'=>1
            ]);
        }
    }
}
