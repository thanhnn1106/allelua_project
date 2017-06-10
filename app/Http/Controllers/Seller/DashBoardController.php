<?php
namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function index(Request $request)
    {
        $data = array();

        return view('seller.dashboard.index', $data);
    }
}