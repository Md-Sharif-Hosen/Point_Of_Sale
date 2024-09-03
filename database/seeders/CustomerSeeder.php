<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Customers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Customer::truncate();
        Customer::create([
            'name' => 'John Doe',
            'email' => 'johndmkoe@example.com',
            'mobile'=>'01728767552',
            'user_id'=>1
        ]);
        Customer::create([
            'name' => 'ashik',
            'email' => 'johndoe4k@example.com',
            'mobile'=>'01728765552',
            'user_id'=>1
        ]);
        Customer::create([
            'name' => 'Tamu',
            'email' => 'johndoe@example.com',
            'mobile'=>'01728767552',
            'user_id'=>1
        ]);
        Customer::create([
            'name' => 'Doe',
            'email' => 'johndo4e@example.com',
            'mobile'=>'01728767552',
            'user_id'=>2
        ]);
    }
}
