<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           $user= User::create([
                'name'=> 'Super Admin',
                'email'=>'super_admin@app.com',
                'user_role'=> 'admin',
                'password'=>hash::make('12345678')
            ]);
            $user->attachRole('super_admin');
    }
}
