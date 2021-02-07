<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    // カラムを指定
    protected $guarded = ['id'];

    protected $fillable = [
        'genfield_id', 'part', 'comment', 'action',
    ];

    // // created_atを使わない場合はfalseを指定する。
    // public $timestamps = false;
}
