<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => '一般ユーザー',
            'email' => 'user@user.user',
            'password' => Hash::make('password'),
            'email_verified_at' => '2024-01-01 00:00:00',
            'user_property_id' => '3',
        ]);
        User::create([
            'name' => '店舗ユーザー',
            'email' => 'shop@shop.shop',
            'password' => Hash::make('password'),
            'email_verified_at' => '2024-01-01 00:00:00',
            'user_property_id' => '2',
        ]);
        User::create([
            'name' => '管理ユーザー',
            'email' => 'admin@admin.admin',
            'password' => Hash::make('password'),
            'email_verified_at' => '2024-01-01 00:00:00',
            'user_property_id' => '1',
        ]);
    }
}
