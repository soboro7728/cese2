<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Review;

class reviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Review::create([
            'user_id' => '1',
            'shop_id' => '1',
            'stars' => '1',
            'comment' => 'てすと',
        ]);
        Review::create([
            'user_id' => '1',
            'shop_id' => '2',
            'stars' => '2',
            'comment' => 'てすと',
        ]);
        Review::create([
            'user_id' => '1',
            'shop_id' => '3',
            'stars' => '3',
            'comment' => 'てすと',
        ]);
        Review::create([
            'user_id' => '2',
            'shop_id' => '1',
            'stars' => '4',
            'comment' => 'てすと',
        ]);
    }
}
