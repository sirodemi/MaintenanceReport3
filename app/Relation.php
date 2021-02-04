<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    protected $table = 'comments';

    // カラムを指定
    protected $guarded = ['id'];
    protected $fillable = [
        'comment',
        'syojo',
        'part',
        'cause',
    ];

    // // created_atを使わない場合はfalseを指定する。
    public $timestamps = false;
}
