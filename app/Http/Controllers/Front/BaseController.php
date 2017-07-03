<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Languages;

class BaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->lang = \App::getLocale();
    }
}
