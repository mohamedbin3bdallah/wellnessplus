<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    protected $table = 'packages';

    protected $fillable = [
        'name', 'active', 'discountPercentage', 'icon', 'numOfHours', 'organization_flag'
    ];
}
