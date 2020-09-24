<?php

use Illuminate\Database\Seeder;

class ProductHasCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_has_category = new \App\Models\ProductHasCategory();

        $product_has_category->create([
            'product_id'  => 1,
            'category_id' => 1
        ]);

        $product_has_category->create([
            'product_id'  => 2,
            'category_id' => 1
        ]);
    }
}
