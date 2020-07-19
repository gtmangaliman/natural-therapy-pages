<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Categories;


class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Categories::class, 5)->create();
    }
}
