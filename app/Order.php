<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function orderItems()
    {
        return $this->hasMany('App\OrderItem', 'order_id', 'id');
    }
}
