<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLanguages extends Model
{
    protected $table = 'user_language';

    protected $fillable = ['user_id', 'language_id', 'level_id', 'created_by', 'updated_by'];


    public function user()
    {
        return $this->belongsTo('App\instructor','user_id','id');

    }

    public function language()
    {
        return $this->hasOne('App\AllLanguages','id','language_id');

    }

    public function level()
    {
        return $this->hasOne('App\LanguageLevels','id','level_id');

    }
}
