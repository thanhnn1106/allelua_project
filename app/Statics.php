<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statics extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'statics';

    public function staticTranslates()
    {
        return $this->hasMany('App\StaticsTranslate', 'static_id', 'id');
    }

}
