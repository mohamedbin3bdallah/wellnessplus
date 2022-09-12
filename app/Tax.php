<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $table = 'taxes';

    protected $fillable = ['id', 'name', 'rate', 'status', 'created_at', 'updated_at' ];
}
