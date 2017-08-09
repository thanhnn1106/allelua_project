<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_items';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function seller()
    {
        return $this->belongsTo('App\User', 'seller_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
