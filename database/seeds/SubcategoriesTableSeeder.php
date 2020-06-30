<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,3) as $index)
        DB::table('subcategories')->insert([
            'name'=>$faker->sentence(3),
            'category_id'=>$faker->randomDigit(3),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
