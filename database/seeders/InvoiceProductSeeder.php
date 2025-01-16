<?php

namespace Database\Seeders;

use App\Models\InvoiceProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InvoiceProduct::create([
            'invoice_id' => 1,
            'product_id' => 5,
            'user_id' => 1,
            'qty' => "2",
            "sale_price"=>"1000"
        ]);
        InvoiceProduct::create([
            'invoice_id' => 2,
            'product_id' => 1,
            'user_id' => 1,
            'qty' => "1",
            "sale_price"=>"2000"
        ]);
        InvoiceProduct::create([
            'invoice_id' => 3,
            'product_id' => 4,
            'user_id' => 1,
            'qty' => "1",
            "sale_price"=>"5000"
        ]);
    }
}
