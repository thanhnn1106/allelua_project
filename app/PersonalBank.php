<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalBank extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'personal_bank';

    public function personal()
    {
        return $this->belongsTo('App\Personal', 'personal_id');
    }
}
