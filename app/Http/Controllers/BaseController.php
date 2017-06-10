<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Languages;

class BaseController extends Controller
{
    protected function getLanguages()
    {
        $langs = Languages::all(array('iso2', 'name'));

        return $langs;
    }
    protected function getIso2Lang()
    {
        $langs = $this->getLanguages();
        $langs = array_column($langs->toArray(), 'iso2');

        return $langs;
    }
}
