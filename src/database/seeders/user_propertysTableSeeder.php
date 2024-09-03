<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User_property;

class user_propertysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User_property::create([
            'property' => '管理者ユーザー',
        ]);
        User_property::create([
            'property' => '店舗ユーザー',
        ]);
        User_property::create([
            'property' => '一般ユーザー',
        ]);
    }
}
