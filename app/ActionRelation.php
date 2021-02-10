<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionRelation extends Model
{
    protected $table = 'action_relations';

    // カラムを指定
    protected $guarded = ['id'];
    protected $fillable = ['comment_id', 'action_id'];

    // // created_atを使わない場合はfalseを指定する。
    // public $timestamps = false;
}
