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
        foreach(range(1,10) as $index)
        DB::table('products')->insert([
            'name'=>$faker->sentence(3),
            'code'=>$faker->randomDigit(10),
            'resume'=>$faker->sentence(1),
            'detail'=>$faker->sentence(20),
            'cover'=>$faker->image('public/storage/covers',400,300, null, false),
            'category_id'=>$faker->randomDigit(10),
            'subcategory_id'=>$faker->randomDigit(10),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}

