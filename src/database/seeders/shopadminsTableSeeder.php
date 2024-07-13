<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Seeder;
use App\Models\Shopadmin;
use Illuminate\Support\Facades\Hash;

class shopadminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shopadmin::create([
            'name' => '店舗代表者',
            'email' => 'shop@shop.shop',
            'shop_id' => '1',
            'password' => Hash::make('password')
        ]);
    }
}
