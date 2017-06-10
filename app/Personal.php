<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'personal';

    public function user()
    {
        return $this->belongsTo('App\Users', 'user_id');
    }

    public function personalTranslates()
    {
        return $this->hasMany('App\PersonalTranslate', 'personal_id', 'id');
    }

    public function personalBanks()
    {
        return $this->hasMany('App\PersonalBank', 'personal_id', 'id');
    }
}
