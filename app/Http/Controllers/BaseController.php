<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Languages;

class BaseController extends Controller
{
    protected function getIso2Lang()
    {
        $langs = Languages::getResults();
        $langs = array_column($langs->toArray(), 'iso2');

        return $langs;
    }
}
