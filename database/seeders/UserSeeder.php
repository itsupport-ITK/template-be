<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate([
            'email' => 'itsupport@itk.ac.id',
        ], [
            'name' => 'IT Support',
            'password' => Hash::make('its124')
        ]);

        $user->roles()->sync(1);
    }
}
