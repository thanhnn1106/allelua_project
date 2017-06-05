<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Roles;
use App\Countries;

class BaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    protected function getRoles()
    {
        $roles = Roles::where('id', '!=', 1)->get(array('id', 'role'));

        return $roles;
    }

    protected function getCoutries()
    {
        $countries = Countries::all(array('id', 'name'));

        return $countries;
    }
}
