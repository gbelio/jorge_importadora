<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([CategoriesTableSeeder::class]);
        $this->call([SubcategoriesTableSeeder::class]);
        $this->call([MultimediaTableSeeder::class]);
        $this->call([ProductsTableSeeder::class]);
        
       /*  $this->call(UsersTableSeeder::class); */
    }
}