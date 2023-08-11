<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Owner;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Owner::factory(30)->create();
    }
}
