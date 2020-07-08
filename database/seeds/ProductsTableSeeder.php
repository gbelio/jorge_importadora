<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Faker\Provider\Base;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,50) as $index)
        DB::table('products')->insert([
            'name'=>$faker->sentence(3),
            'code'=>$faker->randomDigit(),
            'resume'=>$faker->sentence(1),
            'description'=>$faker->sentence(20),
            'cover'=>'covers/' . $faker->image('public/storage/covers',400,300, null, false),
            'category_id'=>rand(1, 3),
            'subcategory_id'=>rand(1, 3),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}