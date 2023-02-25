<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker; 

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create(); 
        foreach(range(1, 20) as $index) 
        {
            DB::table('students')->insert([
                'firstname' => $faker->firstName, 
                'lastname' => $faker->lastName, 
                'email' => $faker->email, 
                'phone' => $faker->phoneNumber,
            ]);
        }
    }
}
