<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = ['logo', 'favicon', 'paytm_enable', 'payment_getway', 'whatsapp_mobile'];

    protected $casts = [
        'ipblock' => 'array'
    ];
}
