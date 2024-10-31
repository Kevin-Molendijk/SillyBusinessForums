<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Maak een admin-gebruiker
        User::create([
            'name' => 'SillyBusinessMan(A)',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'), // Gebruik een veilige wachtwoord-hash
            'role' => 'admin',
        ]);

        // Maak een normale gebruiker
        User::create([
            'name' => 'SillyShareholder(U)',
            'email' => 'user@user.com',
            'password' => Hash::make('12345678'),
            'role' => 'user',
        ]);
    }
}
