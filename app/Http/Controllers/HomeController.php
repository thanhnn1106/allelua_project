<?php
namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    public function index(Request $request)
    {
        $data = array(
            'langs' => \App\Languages::getResults()
        );

        return view('home', $data);
    }
}