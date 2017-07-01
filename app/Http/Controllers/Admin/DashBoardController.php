<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Http\Request;

class DashBoardController extends AdminBaseController
{
    public function index(Request $request)
    {
        $data = array();

        return view('admin.dashboard.index', $data);
    }
}