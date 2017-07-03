<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Front\BaseController;

class ProductController extends BaseController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $category, $id, $seo_slug = null)
    {
        $cateObj = \App\CategoriesTranslate::where('category_id', $id)->where('slug', $category)->where('language_code', $this->lang)->first();

        $cateChildObj = null;
        if (!empty($seo_slug)) {
            $cateId = getIdFromSlug($seo_slug);
            $cateChildObj = \App\CategoriesTranslate::where('category_id', $cateId)->where('language_code', $this->lang)->first();
        }

        return view('front.product.index', [
            'cateObj' => $cateObj,
            'cateChildObj' => $cateChildObj,
        ]);
    }
}
