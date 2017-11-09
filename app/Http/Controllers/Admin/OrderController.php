<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Order;

class OrderController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Setting config as: rate and social
     * @param Request $request
     * @return type
     */
    public function index(Request $request)
    {
        $orderList = Order::getList();
        return view('admin.order.list', [
            'orderList'      => $orderList,
        ]);
    }

}
