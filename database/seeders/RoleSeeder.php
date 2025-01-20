<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'admin',
                'desc' => [
                    'en' => 'Admin',
                    'id' => 'Admin',
                ],
            ],
            // bisa diganti sesuai kebutuhan
            [
                'name' => 'user',
                'desc' => [
                    'en' => 'User',
                    'id' => 'user',
                ],
            ]
 
        ];

        foreach ($data as $key => $value) {
            Role::firstOrCreate(
                [
                    'name' => $value['name'],
                ]
            );
        }
    }
}
