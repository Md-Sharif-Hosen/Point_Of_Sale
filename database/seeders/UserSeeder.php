<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::truncate();
        User::create([
            'firstName' => 'Sharif',
            'lastName' => 'Hosen',
            'email' => 'mdsharifkhan762@gmail.com',
            'mobile'=>'01728767552',
            'password' => bcrypt('secret'),
            'otp'=>'0'
        ]);
        User::create([
            'firstName' => 'Tamanna',
            'lastName' => 'Sayma',
            'email' => 'tamannasayma39@gmail.com',
            'mobile'=>'01305038291',
            'password' => bcrypt('secret'),
            'otp'=>'0'
        ]);
        User::create([
            'firstName' => 'Adnan',
            'lastName' => 'Sharif',
            'email' => 'mdsharifahemd933@gmail.com',
            'mobile'=>'01325060539',
            'password' => bcrypt('secret'),
            'otp'=>'0'
        ]);
    }
}
