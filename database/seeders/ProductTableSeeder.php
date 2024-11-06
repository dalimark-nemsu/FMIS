<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path("app/cse.json");

        // Load and decode the JSON file
        $jsonData = file_get_contents($path);
        $products = json_decode($jsonData, true);

        foreach ($products as $key => $product) {
            Product::create([
                'product_code' => $product['Product Code'],
                'product_description' => $product['Product Description'],
                'uom' => $product['UOM'],
                'price' => floatval($product['Price']),
                'remarks' => $product['Remarks'],
                'is_available'  => ((int)$product['Quantity'] !== 0) ? true : false,
            ]);
        }
    }
}
