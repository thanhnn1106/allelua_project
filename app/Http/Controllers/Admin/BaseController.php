<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Roles;
use App\Countries;
use App\Languages;
use App\Generals;

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

    protected function getLanguages()
    {
        $roles = Languages::all(array('id', 'iso2', 'name'));

        return $roles;
    }

    protected function getCoutries()
    {
        $countries = Countries::all(array('id', 'name'));

        return $countries;
    }

    protected function getGenerals()
    {
        $generals = Generals::all();

        return $generals;
    }

    protected function removeFile($filePath) {
        if (file_exists(public_path() . $filePath)) {
            @unlink(public_path() . $filePath);
        }
    }
}
