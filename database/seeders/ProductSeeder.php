<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
          "user_id"=>1,
          "category_id"=>1,
          "name"=>"Monitor",
           "price"=>"2000",
           "unit"=>"1 pics",
           "img_url"=>"uploads/HP monitor.jpg"
        ]);
        Product::create([
            "user_id"=>1,
            "category_id"=>1,
            "name"=>"keyboard",
             "price"=>"200",
             "unit"=>"1 pics",
             "img_url"=>"uploads/keyboard.jpg"
          ]);
          Product::create([
            "user_id"=>1,
            "category_id"=>1,
            "name"=>"Mouse",
             "price"=>"100",
             "unit"=>"1 pics",
             "img_url"=>"uploads/mouse.jpg"
          ]);
          Product::create([
            "user_id"=>1,
            "category_id"=>3,
            "name"=>"POS application",
             "price"=>"5000",
             "unit"=>"1",
             "img_url"=>"uploads/pos_app.png"
          ]);
          Product::create([
            "user_id"=>1,
            "category_id"=>2,
            "name"=>"Router",
             "price"=>"500",
             "unit"=>"1",
             "img_url"=>"uploads/router.jpg"
          ]);
          Product::create([
            "user_id"=>1,
            "category_id"=>4,
            "name"=>"Camera",
             "price"=>"1000",
             "unit"=>"1",
             "img_url"=>"uploads/camera.jpg"
          ]);
    }
}
