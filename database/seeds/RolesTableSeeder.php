<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        DB::table('roles')->insert([
            'name' => 'Admin',
            'slug' =>'admin',
            'created_at' => now(),
            'updated_at' =>now(),
        ]);

    
    DB::table('roles')->insert([
            'name' => 'Author',
            'slug' =>'author',
            'created_at' => now(),
            'updated_at' =>now(),
        ]);
    }
}
