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
            'name' => 'Electronics',
            'user_id'=>1
        ]);

        Category::create([
            'name' => 'Clothing',
            'user_id'=>2
        ]);
        Category::create([
            'name' => 'Books',
            'user_id'=>3
        ]);
        Category::create([
            'name' => 'Computer',
            'user_id'=>1
        ]);
        Category::create([
            'name' => 'Home & Garden',
            'user_id'=>2
        ]);
    }
}
