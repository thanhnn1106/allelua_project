<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerShipping extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customer_shipping';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
