<?php

namespace Database\Seeders;

use App\Models\Vendor\Category;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriesData = json_decode(file_get_contents(database_path('seeds/categories.json')), true);

        foreach ($categoriesData['categories'] as $categoryData) {
            Category::create([
                'name' => $categoryData['name'],
                'slug' => $categoryData['slug'],
                'position' => $categoryData['position'],
                'featured' => $categoryData['featured'],
                'description' => $categoryData['description'],
                'status' => $categoryData['status'],
            ]);
        }
    }
}
