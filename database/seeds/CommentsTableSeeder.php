<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            [
                'comment' => '充電器不良によるバッテリー電圧低下の為、始動する事が出来ません。',
                'syojo' => '1',
                'part' => '1',
                'cause' => '1',
            ],
            [
                'comment' => '交換時期超過によるバッテリー電圧低下の為、始動する事が出来ません。',
                'syojo' => '1',
                'part' => '1',
                'cause' => '2',
            ],
            [
                'comment' => '燃料噴射ポンプ固着の為、始動する事が出来ません。',
                'syojo' => '1',
                'part' => '2',
                'cause' => '3',
            ],
            [
                'comment' => '燃料切れの為、始動する事が出来ません。',
                'syojo' => '1',
                'part' => '3',
                'cause' => '4',
            ],
            [
                'comment' => 'セルモーターブラシ固着の為、始動する事が出来ません。',
                'syojo' => '1',
                'part' => '4',
                'cause' => '5',
            ],
            [
                'comment' => '制御盤不良の為、制御盤操作で始動する事が出来ません。',
                'syojo' => '1',
                'part' => '5',
                'cause' => '6',
            ],
            [
                'comment' => '冷却水ポンプ劣化の為、冷却水漏れが見受けられます。',
                'syojo' => '2',
                'part' => '6',
                'cause' => '7',
            ],
            [
                'comment' => '潤滑油に燃料希釈による増加が見受けられます。',
                'syojo' => '3',
                'part' => '2',
                'cause' => '8',
            ],
            [
                'comment' => '部品供給終了の為、補修が出来ません。',
                'syojo' => '4',
                'part' => '7',
                'cause' => '9',
            ],
            [
                'comment' => '潤滑油フィルタードレンOリング劣化の為、潤滑油漏れが見受けられます。',
                'syojo' => '5',
                'part' => '8',
                'cause' => '10',
            ],
            [
                'comment' => '冷却水温度計の指針動作不良の為、指示位置の誤差が見受けられます。',
                'syojo' => '6',
                'part' => '9',
                'cause' => '11',
            ],
            [
                'comment' => '潤滑油温度計の指針動作不良の為、指示位置の誤差が見受けられます。',
                'syojo' => '6',
                'part' => '10',
                'cause' => '11',
            ],
            [
                'comment' => '回転速度計の指針動作不良の為、指示位置の誤差が見受けられます。',
                'syojo' => '6',
                'part' => '11',
                'cause' => '11',
            ],
            [
                'comment' => '潤滑油圧力計の指針動作不良の為、指示位置の誤差が見受けられます。',
                'syojo' => '6',
                'part' => '12',
                'cause' => '11',
            ],
            [
                'comment' => '冷却水ヒータが動作していなかった為、エンジンが冷えて始動する事が出来ませんでした。',
                'syojo' => '1',
                'part' => '13',
                'cause' => '12',
            ],
            [
                'comment' => '交換推奨時期超過の為、バッテリーが膨張しています。',
                'syojo' => '1',
                'part' => '1',
                'cause' => '1',
            ],
            [
                'comment' => 'バッテリーの交換推奨時期を超過しており、始動不能が発生する可能性があります。',
                'syojo' => '1',
                'part' => '1',
                'cause' => '1',
            ],
            [
                'comment' => '圧力計のゼロ指示位置がずれています。',
                'syojo' => '1',
                'part' => '1',
                'cause' => '1',
            ],
        ]);
    }
}
