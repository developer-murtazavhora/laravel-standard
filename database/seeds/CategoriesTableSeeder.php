<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new \App\Models\Category();

        $category->create([
            'title'       => 'Laptop',
            'identifier'  => 'laptop',
            'description' => 'Laptop Description',
            'is_active'   => 1,
            'added_by'    => 1,
        ]);
    }
}
