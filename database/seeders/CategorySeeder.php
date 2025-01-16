<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category::truncate();
        Category::create([
            'name' => 'Computer Accessories',
            'user_id'=>1
        ]);

        Category::create([
            'name' => 'Network Component',
            'user_id'=>1
        ]);
        Category::create([
            'name' => 'Software',
            'user_id'=>1
        ]);
        Category::create([
            'name' => 'Camera Accessories',
            'user_id'=>1
        ]);
    }
}
