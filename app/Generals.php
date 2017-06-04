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
    protected $table = 'languages';

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }
}
