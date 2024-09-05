<?php

namespace Database\Seeders;

use App\Models\Shoptest;
use App\Models\Shoptests;
use Illuminate\Database\Seeder;

class shoptestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Shoptest::create([
            'name' => '仙人',
            'region' => '東京都',
            'genre' => 'ラーメン',
            'image_path' => 'sushi.jpg',
            'detail' => '料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。食材・味・価格、お客様の満足度を徹底的に追及したお店です。特別な日のお食事、ビジネス接待まで気軽に使用することができます。',
        ]);
        Shoptest::create([
            'name' => '仙人２',
            'region' => '大阪府',
            'genre' => 'ラーメン',
            'image_path' => 'sushi.jpg',
            'detail' => '料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。食材・味・価格、お客様の満足度を徹底的に追及したお店です。特別な日のお食事、ビジネス接待まで気軽に使用することができます。',
        ]);
        Shoptest::create([
            'name' => '仙人3',
            'region' => '大阪府',
            'genre' => 'ラーメン',
            'image_path' => 'sushi.jpg',
            'detail' => '料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。食材・味・価格、お客様の満足度を徹底的に追及したお店です。特別な日のお食事、ビジネス接待まで気軽に使用することができます。',
        ]);
    }
}
