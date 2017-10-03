<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function __construct() {
        $this->lang = \App::getLocale();

        \View::share('sp_categories', $this->loadMenuFront());
    }
}