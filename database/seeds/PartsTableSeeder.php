<?php

use Illuminate\Database\Seeder;

class PartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parts')->insert([
            [
                'part' => 'バッテリー',
            ],
            [
                'part' => '燃料噴射ポンプ',
            ],
            [
                'part' => '燃料タンク',
            ],
            [
                'part' => 'セルモーター',
            ],
            [
                'part' => '制御盤',
            ],
            [
                'part' => '冷却水ポンプ',
            ],
            [
                'part' => '設備全体',
            ],
            [
                'part' => '潤滑油フィルター',
            ],
            [
                'part' => '冷却水温度計',
            ],
            [
                'part' => '潤滑油温度計',
            ],
            [
                'part' => '回転速度計',
            ],
            [
                'part' => '潤滑油圧力計',
            ],
            [
                'part' => '冷却水ヒーター',
            ],
            [
                'part' => '空気槽圧力計',
            ],
        ]);
    }
}
