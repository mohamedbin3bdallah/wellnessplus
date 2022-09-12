<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SearchLog extends Model
{
    protected $fillable = ['specialities', 'rate', 'countries', 'residences', 'availability', 'languages', 'name', 'user_id'];
}
