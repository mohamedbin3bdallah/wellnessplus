<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutor_payment_info extends Model
{
    protected $table = 'tutor_payment_info';

    protected $fillable = [ 'tutor_id', 'account_name', 'account_number', 'iban'];
}
