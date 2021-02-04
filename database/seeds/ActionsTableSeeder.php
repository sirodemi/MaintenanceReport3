<?php

use Illuminate\Database\Seeder;

class ActionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('actions')->insert([
            [
                'action' => '充電器の交換が必要です。',
            ],
            [
                'action' => '充電器とバッテリーの交換が必要です。',
            ],
            [
                'action' => 'バッテリーの交換が必要です。',
            ],
            [
                'action' => '燃料噴射ポンプの整備が必要です。',
            ],
            [
                'action' => '燃料噴射ポンプの交換が必要です。',
            ],
            [
                'action' => '燃料噴射ポンプの整備または交換が必要です。',
            ],
            [
                'action' => '部品供給終了の為、補修が出来ません。設備全体の更新が必要です。',
            ],
            [
                'action' => '燃料の補給が必要です。',
            ],
            [
                'action' => 'セルモーターの交換が必要です。',
            ],
            [
                'action' => '制御盤の交換が必要です。',
            ],
            [
                'action' => '冷却水ポンプの交換が必要です。',
            ],
            [
                'action' => '定期的な潤滑油の交換を推奨します。',
            ],
            [
                'action' => '潤滑油の交換が必要です。',
            ],
            [
                'action' => '潤滑油フィルターと併せてOリングの交換を推奨します。',
            ],
            [
                'action' => '冷却水温度計の交換が必要です。',
            ],
            [
                'action' => '潤滑油温度計の交換が必要です。',
            ],
            [
                'action' => '回転速度計の交換が必要です。',
            ],
            [
                'action' => '潤滑油圧力計の交換が必要です。',
            ],
            [
                'action' => '冷却水ヒータの交換が必要です。',
            ],
            [
                'action' => '空気槽圧力計の交換が必要です。',
            ],
            [
                'action' => '空気槽の部品交換が必要です。',
            ],
        ]);
    }
}
