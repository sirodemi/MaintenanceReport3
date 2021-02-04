<?php

use Illuminate\Database\Seeder;

class SyojosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('syojos')->insert([
            [
                'syojo' => '始動しない',
            ],
            [
                'syojo' => '冷却水漏れ',
            ],
            [
                'syojo' => '潤滑油希釈',
            ],
            [
                'syojo' => '設置年数',
            ],
            [
                'syojo' => '潤滑油漏れ',
            ],
            [
                'syojo' => '指示不良',
            ],
            [
                'syojo' => '外観不良',
            ],
            [
                'syojo' => '交換推奨期限超過',
            ],
        ]);
    }
}
