<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $address = new Address([
            'cep' => '36530-000',
            'publicPlace' => 'Rua das Graças',
            'district' => 'Bairro Santo Antônio',
            'uf' => 'SP',
            'city' => 'São Paulo',
            'num' => '123'
        ]);

        $address->save();

        $user = new User([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'dateBirth' => '2002-03-25',
            'phone' => '(32) 98414-8570' ,
            'workTime' => '12',
            'isAdmin' => true
        ]);

        $user->address()->associate($address);
        $user->save();
    }
}
