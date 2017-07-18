<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaticsTranslate extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'statics_translate';

    public function product()
    {
        return $this->belongsTo('App\Statics', 'static_id');
    }

    public function language()
    {
        return $this->belongsTo('App\Languages', 'language_code');
    }
}
