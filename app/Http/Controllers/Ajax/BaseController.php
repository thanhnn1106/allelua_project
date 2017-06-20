<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    protected $lang;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->lang = \App::getLocale();
    }

    protected function getStyle($objCate, $objSub)
    {
        if ($objCate->type === 'gach_men') {
            $hasKey = \Config::has("product.{$objCate->type}");
            if (!$hasKey) {
                return '';
            }
            $data = config("product.{$objCate->type}");
        } else {
            $hasKey = \Config::has("product.{$objCate->type}.{$objSub->type}");
            if (!$hasKey) {
                return '';
            }
            $data = config("product.{$objCate->type}.{$objSub->type}");
        }
        $html = \View::make('ajax.product.style', array('data' => $data))->render();

        return $html;
    }

    protected function removeFile($filePath) {
        if (file_exists(public_path() . $filePath)) {
            @unlink(public_path() . $filePath);
        }
    }
}
