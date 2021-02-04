<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    // カラムを指定
    protected $guarded = ['id'];
    protected $fillable = ['part'];

    // // created_atを使わない場合はfalseを指定する。
    public $timestamps = false;
}
