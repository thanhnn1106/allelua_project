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

    /**
     * Get customer's order history list.
     *
     * @var object array
     * @author Nguyễn Ngọc Thanh <thanh.nn1106@gmail.com>
     */
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

    /**
     * Get order list for seller.
     *
     * @var object array
     * @author Nguyễn Ngọc Thanh <thanh.nn1106@gmail.com>
     */
    public static function getOrderList($userId)
    {
        $orderList = \DB::table('orders AS o')
                ->select('o.status', 'oi.*', 'u.full_name', 'u.email', 'u.phone_number AS order_phone', 'o.phone AS receive_phone', 'o.address')
                ->join('order_items AS oi', 'oi.order_id', '=', 'o.id')
                ->join('users AS u', 'o.user_id', '=', 'u.id')
                ->where('oi.seller_id', '=', $userId)
                ->orderBy('o.created_at', 'desc');
        $result = $orderList->paginate(LIMIT_ROW);
        return $result;
    }

    /**
     * Get order list for admin.
     *
     * @var object array
     * @author Nguyễn Ngọc Thanh <thanh.nn1106@gmail.com>
     */
    public static function getList()
    {
        $orderList = \DB::table('orders AS o')
                ->select('o.status', 'oi.*', 'u.company_name AS seller_name', 'u1.email AS customer_email', 'u1.full_name AS customer_full_name', 'o.phone AS receive_phone', 'u1.phone_number AS order_phone')
                ->join('order_items AS oi', 'oi.order_id', '=', 'o.id')
                ->join('users AS u', 'u.id', '=', 'oi.seller_id')
                ->join('users AS u1', 'u1.id', '=', 'o.user_id')
                ->orderBy('o.created_at', 'desc');
        $result = $orderList->paginate(LIMIT_ROW);
        return $result;
    }

    /**
     * Seller update order status.
     *
     * @var object array
     * @author Nguyễn Ngọc Thanh <thanh.nn1106@gmail.com>
     */
    public static function updateOrderStatus($orderId)
    {
        $orderInfo = Order::find($orderId);
        $orderInfo->status = config('allelua.order_status_value.processed');
        $result = $orderInfo->save();
        return $result;
    }
}
