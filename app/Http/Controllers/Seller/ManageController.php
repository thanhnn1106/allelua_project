<?php
namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Seller\BaseController;
use Illuminate\Http\Request;

class ManageController extends BaseController
{
    public function index(Request $request)
    {
        $data = array();
        echo 'This is seller';exit;

//        return view('admin.index', $data);
    }
}