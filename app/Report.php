<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    // カラムを指定
    protected $guarded = ['id'];

    protected $fillable = [
        'report_id', 'genfield_id', 'part', 'comment', 'action',
    ];


    // 現場情報をリレーションで取得
    public function genfield()
    {
        return $this->belongsTo('App\GenFieldField');
    }

    // 機器情報をリレーションで取得
    public function generalset()
    {
        return $this->belongsTo('App\GenFieldGeneralSet');
    }
}
