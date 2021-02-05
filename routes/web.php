<?php

// メニュー画面
Route::get('/', function () {
    return view('welcome');
});


// 所見を選んで印刷、保存
Route::get('syoken', 'SyokenController@index'); //読込
Route::post('syoken_save', 'SyokenController@syoken_save'); //保存


// 症状関連項目
Route::get('syojo', 'SyojoController@index')->name('syojo'); //読込
Route::post('syojo', 'SyojoController@save'); //登録
Route::delete('/syojo/{syojo}', 'SyojoController@delete'); //削除
Route::post('/syojo_edit/{syojo}', 'SyojoController@edit'); //編集
Route::post('/syojo/update', 'SyojoController@update'); //更新処理


// 不良箇所関連項目
Route::get('part', 'PartController@index')->name('part'); //読込
Route::post('part', 'PartController@save'); //登録
Route::delete('/part/{part}', 'PartController@delete'); //削除
Route::post('/part_edit/{part}', 'PartController@edit'); //編集
Route::post('/part/update', 'PartController@update'); //更新処理


// 原因関連項目
Route::get('cause', 'CauseController@index')->name('cause'); //読込
Route::post('cause', 'CauseController@save'); //登録
Route::delete('/cause/{cause}', 'CauseController@delete'); //削除
Route::post('/cause_edit/{cause}', 'CauseController@edit'); //編集
Route::post('/cause/update', 'CauseController@update'); //更新


// 関係性項目
Route::get('relation', 'RelationController@index')->name('relation'); //読込
Route::post('relation', 'RelationController@save'); //登録
Route::delete('/relation/{relation}', 'RelationController@delete'); //削除
Route::post('/relation_edit/{relation}', 'RelationController@edit'); //編集
Route::post('/relation/update', 'RelationController@update'); //更新


// 処置項目
Route::get('action', 'ActionController@index')->name('action'); //読込
Route::post('action', 'ActionController@save'); //登録
Route::delete('/action/{action}', 'ActionController@delete'); //削除
Route::post('/action_edit/{action}', 'ActionController@edit'); //編集
Route::post('/action/update', 'ActionController@update'); //更新


// 現場情報と印刷情報
Route::post('print', 'PrintController@index')->name('print'); //現場情報と印刷情報を読込む
Route::post('print_save', 'PrintController@save')->name('print_save'); //印刷情報編集





// ここから下は不使用
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
