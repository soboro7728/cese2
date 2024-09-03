<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Condition;

class conditionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Condition::create([
            'condition' => 'ランダム',
        ]);
        Condition::create([
            'condition' => '評価が高い順',
        ]);
        Condition::create([
            'condition' => '評価は低い順',
        ]);
    }
}
