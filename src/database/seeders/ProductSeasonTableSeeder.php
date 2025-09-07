<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeasonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_season')->insert([
            //キウイ
            ['product_id' => 1, 'season_id' => 3],
            ['product_id' => 1, 'season_id' => 4],
            //ストロベリー
            ['product_id' => 2, 'season_id' => 1],
            //オレンジ
            ['product_id' => 3, 'season_id' => 4],
            //スイカ
            ['product_id' => 4, 'season_id' => 2],
            //ピーチ
            ['product_id' => 5, 'season_id' => 2],
            //シャインマスカット
            ['product_id' => 6, 'season_id' => 2],
            ['product_id' => 6, 'season_id' => 3],
            //パイナップル
            ['product_id' => 7, 'season_id' => 1],
            ['product_id' => 7, 'season_id' => 2],
            //ブドウ
            ['product_id' => 8, 'season_id' => 2],
            ['product_id' => 8, 'season_id' => 3],
            //バナナ
            ['product_id' => 9, 'season_id' => 2],
            //メロン
            ['product_id' => 10, 'season_id' => 1],
            ['product_id' => 10, 'season_id' => 2],
        ]);
    }
}
