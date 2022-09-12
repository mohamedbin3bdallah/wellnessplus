<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tutorEducation extends Model
{
    protected $table = 'tutor_education';

    protected $fillable = ['tutor_id', 'university', 'degree', 'specialty', 'file', 'from', 'to'];
}
