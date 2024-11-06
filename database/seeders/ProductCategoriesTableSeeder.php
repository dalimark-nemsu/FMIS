<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Cleaning Equipment  and Supplies',
           'Computer Supplies',
            'Electrical Supplies',
            'Office Equipment', 
            'Office Supplies',
            'Paper Products', 
            'Toners and Cartridges', 
            'Writing Supplies'
        ];

        foreach ($categories as $key => $category) {
            ProductCategory::create([
                'name'  =>  $category,
            ]);
        }
    }
}
