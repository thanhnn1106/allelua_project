<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductWatched extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_watched';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
