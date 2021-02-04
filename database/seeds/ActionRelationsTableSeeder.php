<?php

use Illuminate\Database\Seeder;

class ActionRelationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('action_relations')->insert([
                    [
                        'comment_id' => '1',
                        'action_id' => '1',
                    ],
                                        [
                        'comment_id' => '1',
                        'action_id' => '2',
                    ],
                                        [
                        'comment_id' => '2',
                        'action_id' => '3',
                    ],
                                        [
                        'comment_id' => '3',
                        'action_id' => '4',
                    ],
                                        [
                        'comment_id' => '3',
                        'action_id' => '5',
                    ],
                                        [
                        'comment_id' => '3',
                        'action_id' => '6',
                    ],
                                        [
                        'comment_id' => '3',
                        'action_id' => '7',
                    ],
                                        [
                        'comment_id' => '4',
                        'action_id' => '8',
                    ],
                    [
                        'comment_id' => '5',
                        'action_id' => '9',
                    ],
                                        [
                        'comment_id' => '5',
                        'action_id' => '7',
                    ],
                                        [
                        'comment_id' => '6',
                        'action_id' => '10',
                    ],
                    [
                        'comment_id' => '6',
                        'action_id' => '7',
                    ],
                   [
                        'comment_id' => '7',
                        'action_id' => '11',
                    ],
                    [
                        'comment_id' => '7',
                        'action_id' => '7',
                    ],
                                        [
                        'comment_id' => '8',
                        'action_id' => '12',
                    ],
                                        [
                        'comment_id' => '8',
                        'action_id' => '13',
                    ],
                                        [
                        'comment_id' => '9',
                        'action_id' => '',
                    ],
                                        [
                        'comment_id' => '10',
                        'action_id' => '14',
                    ],
                    [
                        'comment_id' => '11',
                        'action_id' => '15',
                    ],
                    [
                        'comment_id' => '12',
                        'action_id' => '16',
                    ],
                    [
                        'comment_id' => '13',
                        'action_id' => '17',
                    ],
                    [
                        'comment_id' => '14',
                        'action_id' => '18',
                    ],
                    [
                        'comment_id' => '15',
                        'action_id' => '19',
                    ],
                    [
                        'comment_id' => '16',
                        'action_id' => '3',
                    ],
                    [
                        'comment_id' => '17',
                        'action_id' => '3',
                    ],
                    [
                        'comment_id' => '18',
                        'action_id' => '20',
                    ],
                    [
                        'comment_id' => '18',
                        'action_id' => '21',
                    ],

        ]);
    }
}
