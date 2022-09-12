<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialties extends Model
{
    protected $table = 'specialties';
    protected $fillable = ['id', 'specialty'];

}
