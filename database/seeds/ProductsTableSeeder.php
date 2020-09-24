<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new \App\Models\Product();

        $product->create([
            'title'       => 'Dell 2020',
            'identifier'  => 'dell-2020',
            'description' => 'Dell 2020 Description',
            'is_active'   => 1,
            'is_featured' => 1,
            'added_by'    => 1,
        ]);

        $product->create([
            'title'       => 'Lenovo 2020',
            'identifier'  => 'lenovo-2020',
            'description' => 'Lenovo 2020 Description',
            'is_active'   => 1,
            'is_featured' => 1,
            'added_by'    => 1,
        ]);
    }
}
