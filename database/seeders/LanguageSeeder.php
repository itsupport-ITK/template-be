<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'name' => 'ID',
                'desc' => [
                    'id' => 'Indonesia',
                    'en' => 'Bahasa'
                ],
                'value' => 'id'
            ],
            [
                'id' => 2,
                'name' => 'EN',
                'desc' => [
                    'id' => 'Inggris',
                    'en' => 'English'
                ],
                'value' => 'en'
            ],
        ];


        foreach ($data as $key => $value) {
            Language::firstOrCreate([
                'id' => $value['id'],
            ],[
                'name' => $value['name'],
                'description' => [
                    'id' => $value['desc']['id'],
                    'en' => $value['desc']['en'],
                ],
                'value' => $value['value']
            ]);
        }
    }
}
