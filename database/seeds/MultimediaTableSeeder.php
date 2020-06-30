<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MultimediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,15) as $index)
        DB::table('multimedia')->insert([
            'path' => 'product/' . $faker->image('public/storage/product',400,300, null, false),
            'product_id' => rand(1, 50),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
