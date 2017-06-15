<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Generals extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'generals';

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function language()
    {
        return $this->belongsTo('App\Languages', 'language_code');
    }

    public static function getResults()
    {
        $generals = Generals::all();
        return $generals;
    }
}
