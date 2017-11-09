<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function index(Request $request)
    {
        return redirect()->route('user_account_management');
    }
}