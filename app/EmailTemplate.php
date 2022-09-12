<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $fillable = [
        'booked_successfully_studnet_email', 'booked_successfully_tutor_email', 'refund_request_email'
	];
}
