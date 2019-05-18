<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id' => '1',
            'name' => 'Md.Admin',
            'username' =>'admin',
            'mobile' =>'01712794033',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' =>now(),
        ]);

        DB::table('users')->insert([
            'role_id' => '2',
            'name' => 'Md.Author',
            'username' =>'author',
            'mobile' =>'01842572537',
            'email' => 'author@gmail.com',
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' =>now(),
        ]);
    
    }
}
