<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['General Fund', 'Regular Fund'];

        foreach ($categories as $key => $category) {
            Category::create([
                'name'  =>  $category
            ]);
        }
    }
}
