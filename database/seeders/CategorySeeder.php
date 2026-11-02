<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Conférence', 'slug' => 'conference'],
            ['name' => 'Atelier', 'slug' => 'atelier'],
            ['name' => 'Concert', 'slug' => 'concert'],
            ['name' => 'Sport', 'slug' => 'sport'],
            ['name' => 'Formation', 'slug' => 'formation'],
            ['name' => 'Networking', 'slug' => 'networking'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['slug' => $category['slug']], $category);
        }
    }
}