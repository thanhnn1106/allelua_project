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

    protected function loadMenuFront()
    {
        $cateObject = \App\Categories::getRowByLang($this->lang, -1);

        $categories = array();
        $childs = array();
        foreach ($cateObject as $item) {
            if (empty($item->parent_id)) {
                $categories[$item->id] = array(
                    'title' => $item->title,
                    'slug' => $item->slug,
                    'parent_id' => $item->parent_id,
                );
            } else {
                $childs[$item->parent_id]['childs'][$item->id] = array(
                    'id'    => $item->id,
                    'title' => $item->title,
                    'slug' => $item->slug,
                    'parent_id' => $item->parent_id,
                );
            }
        }
        foreach ($categories as $id => $item) {
            if(isset($childs[$id])) {
                $categories[$id]['childs'] = $childs[$id]['childs'];
            }
        }

        return $categories;
    }

    protected function loadProductWatched()
    {
        return \App\Product::getProductWatched($this->lang);
    }

    protected function loadProductBestPrice($arrCateId)
    {
        return \App\Product::getProductBestPrice($this->lang, $arrCateId);
    }

    protected function loadMenuBestPrice($productBestPrice)
    {
        $arrMenuBestPrice = array();
        if(count($productBestPrice)) {
            foreach ($productBestPrice as $item) {
                $arrMenuBestPrice[] = array(
                    'id' => $item->category_id,
                    'title' => $item->cate_title,
                    'slug' => $item->cate_slug,
                );
            }
        }
        return $arrMenuBestPrice;
    }

    protected function loadProductCateFilter($request, $cateId)
    {
        $params = array(
            'language_code' => $this->lang,
            'category_id' => $cateId,
        );
        return \App\Product::getProductFilter($params);
    }

    protected function loadProductSubCateFilter($request, $subCateId)
    {
        $params = array(
            'language_code' => $this->lang,
            'sub_category_id' => $subCateId,
        );
        return \App\Product::getProductFilter($params);
    }

    protected function loadImageDetails($product)
    {
        if ($product === NULL) {
            return array();
        }

        $images = \App\ProductImage::where('product_id', $product->id)->orderBy('sort', 'ASC')->get();
        if ($images === NULL) {
            return array();
        }

        $arrFile = array();
        foreach ($images as $item) {
            if (!empty($item->image_rand) && file_exists(public_path().'/'.$item->image_rand)) {
                $arrFile[] = array(
                    'product_id' => $item->product_id,
                    'product_image_id' => $item->id,
                    'real_name' => $item->image_real,
                    'rand_name' => $item->image_rand,
                    'file' => url($item->image_rand),
                    'base_name' => basename($item->image_real),
                );
            }
        }
        $urlDelete = route('ajax_product_delete_file');
        $return = $this->returnFormatFile($urlDelete, $arrFile);

        return $return;
    }
}
