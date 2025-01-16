<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Invoice::create([
         "total"=>"1000",
         'discount'=>"",
         'vat'=>"100",
         'payable'=>'1100',
         'user_id'=>1,
         'customer_id'=>2
       ]);
       Invoice::create([
        "total"=>"2000",
        'discount'=>"",
        'vat'=>"100",
        'payable'=>'2100',
        'user_id'=>1,
        'customer_id'=>3
      ]);
      Invoice::create([
        "total"=>"10000",
        'discount'=>"",
        'vat'=>"200",
        'payable'=>'10200',
        'user_id'=>1,
        'customer_id'=>1
      ]);
      Invoice::create([
        "total"=>"2000",
        'discount'=>"",
        'vat'=>"100",
        'payable'=>'2100',
        'user_id'=>1,
        'customer_id'=>1
      ]);
      Invoice::create([
        "total"=>"1500",
        'discount'=>"",
        'vat'=>"100",
        'payable'=>'1600',
        'user_id'=>1,
        'customer_id'=>1
      ]);
      Invoice::create([
        "total"=>"1000",
        'discount'=>"",
        'vat'=>"100",
        'payable'=>'1100',
        'user_id'=>1,
        'customer_id'=>1
      ]);Invoice::create([
        "total"=>"5000",
        'discount'=>"",
        'vat'=>"100",
        'payable'=>'5100',
        'user_id'=>1,
        'customer_id'=>1
      ]);
    }
}
