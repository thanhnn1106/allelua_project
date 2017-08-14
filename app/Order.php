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
    
    public static function getOrderHistoryList($userId)
    {
        $orderList = \DB::table('orders AS o')
                ->select('o.status', 'oi.*', 'u.company_name')
                ->join('order_items AS oi', 'oi.order_id', '=', 'o.id')
                ->join('users AS u', 'oi.seller_id', '=', 'u.id')
                ->where('o.user_id', '=', $userId)
                ->orderBy('o.created_at', 'desc');
        $result = $orderList->paginate(LIMIT_ROW);
        return $result;
    }
}
