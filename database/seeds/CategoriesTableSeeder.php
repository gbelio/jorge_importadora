<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,3) as $index)
        DB::table('categories')->insert([
            'name'=>$faker->sentence(1),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}