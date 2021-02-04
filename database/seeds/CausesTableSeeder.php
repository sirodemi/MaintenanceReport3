<?php

use Illuminate\Database\Seeder;

class CausesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('causes')->insert([
            [
                'cause' => '充電器不良による電圧低下',
            ],
            [
                'cause' => '交換時期超過による電圧低下',
            ],
            [
                'cause' => '潤滑能力低下によるラック摺動固着',
            ],
            [
                'cause' => '燃料切れによる燃料供給不足',
            ],
            [
                'cause' => 'ブラシ固着による接触不良',
            ],
            [
                'cause' => '制御盤不良による始動不能',
            ],
            [
                'cause' => 'メカニカルシール劣化による冷却水漏れ',
            ],
            [
                'cause' => '潤滑油交換推奨時期超過による燃料希釈',
            ],
            [
                'cause' => '部品供給終了による補修不可',
            ],
            [
                'cause' => '潤滑油フィルタードレンOリング劣化による潤滑油漏れ',
            ],
            [
                'cause' => '指針動作不良による指示位置誤差',
            ],
            [
                'cause' => '外気温が低温時に冷却水ヒータが動作していなかった',
            ],
            [
                'cause' => 'バッテリー膨張',
            ],
            [
                'cause' => 'バッテリーの交換推奨時期超過',
            ],
            [
                'cause' => '指針動作不良による指示位置誤差',
            ],
        ]);
    }
}
