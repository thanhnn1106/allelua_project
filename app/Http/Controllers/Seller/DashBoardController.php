<?php
namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function index(Request $request)
    {
        return redirect()->route('seller_account_management');
    }
}