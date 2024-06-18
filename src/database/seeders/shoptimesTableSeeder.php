<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class shoptimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'id' => '1',
            'shoptime' => '18:00',
        ];
        DB::table('shoptimes')->insert($param);

        $param = [
            'id' => '2',
            'shoptime' => '18:30',
        ];
        DB::table('shoptimes')->insert($param);

        $param = [
            'id' => '3',
            'shoptime' => '19:00',
        ];
        DB::table('shoptimes')->insert($param);

        $param = [
            'id' => '4',
            'shoptime' => '19:30',
        ];
        DB::table('shoptimes')->insert($param);

        $param = [
            'id' => '5',
            'shoptime' => '20:00',
        ];
        DB::table('shoptimes')->insert($param);

        $param = [
            'id' => '6',
            'shoptime' => '20:30',
        ];
        DB::table('shoptimes')->insert($param);

        $param = [
            'id' => '7',
            'shoptime' => '21:00',
        ];
        DB::table('shoptimes')->insert($param);

        $param = [
            'id' => '8',
            'shoptime' => '21:30',
        ];
        DB::table('shoptimes')->insert($param);
    }
}
