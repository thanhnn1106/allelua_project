<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->lang = session()->has( 'applocale' ) ? session()->get( 'applocale' ) : \Config::get('app.fallback_locale');

            \View::share('sp_categories', $this->loadMenuFront());

            return $next($request);
        });
    }
}