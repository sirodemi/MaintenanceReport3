<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Syojo extends Model
{
    // カラムを指定
    protected $guarded = ['id'];
    protected $fillable = ['syojo'];

    // // created_atを使わない場合はfalseを指定する。
    public $timestamps = false;
}
