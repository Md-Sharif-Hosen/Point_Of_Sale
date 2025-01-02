<?php

namespace Database\Seeders;

use App\Models\Test;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      Test::truncate();
      Test::Create([
        'name'=>"Sharif",
        "email"=>"mdsharifhosen@gmail.com"
      ]);
    }
}
