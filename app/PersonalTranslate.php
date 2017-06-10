<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalTranslate extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'personal_translate';

    public function personal()
    {
        return $this->belongsTo('App\Personal', 'personal_id');
    }
}
