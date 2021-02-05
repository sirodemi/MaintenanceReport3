<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//maintenance_lからRO
class GenFieldField extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'gen_field_field';
}
