<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cause extends Model
{
    // カラムを指定
    protected $guarded = ['id'];
    protected $fillable = ['cause'];

    // // created_atを使わない場合はfalseを指定する。
    public $timestamps = false;
}
