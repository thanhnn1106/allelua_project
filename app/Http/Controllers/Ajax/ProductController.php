<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Ajax\BaseController;
use Illuminate\Http\Request;
use App\Categories;

class ProductController extends BaseController
{
    /**
     * Setting config as: rate and social
     * @param Request $request
     * @return type
     */
    public function loadCategories(Request $request)
    {
        try {
            $categoryId = $request->get('categoryId', NULL);
            $html = '<option value="">------</option>';
            if (!empty($categoryId)) {
                $cates = Categories::getRowByLang($this->lang, $categoryId);
                if(count($cates)) {
                    foreach ($cates as $cate) {
                        $html .= '<option value="'.$cate->id.'">'.$cate->title.'</option>';
                    }
                }
            }

            return response()->json(array('error' => 0, 'result' => $html));
        } catch (Exception $e) {
            return response()->json(array('error' => 1, 'result' => trans('common.error_exception_ajax')));
        }
    }

    public function loadStyle(Request $request)
    {
        try {
            $categoryId  = $request->get('categoryId', NULL);
            $subCategory = $request->get('subCategory', NULL);
            $obj = \App\Categories::find($categoryId);
            if ($obj === NULL) {
                return response()->json(array('error' => 0, 'result' => ''));
            }
            $objSub = $obj->subCategories()->find($subCategory);
            if ($objSub === NULL) {
                return response()->json(array('error' => 0, 'result' => ''));
            }
            $html = $this->getStyle($obj, $objSub);

            return response()->json(array('error' => 0, 'result' => $html));
        } catch (Exception $e) {
            return response()->json(array('error' => 1, 'result' => trans('common.error_exception_ajax')));
        }
    }
}
