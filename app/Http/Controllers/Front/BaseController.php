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

    protected function loadProductBestPrice($arrCateId = NULL)
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

    protected function loadProductSearch($request)
    {
        $params = array(
            'language_code' => $this->lang,
            'keyword' => $request->get('q'),
        );
        return \App\Product::getProductFilter($params);
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

        $params = $this->getParamSearch($request, $params);

        return \App\Product::getProductFilter($params);
    }

    protected function loadFilterAttr($loadStyles, $params)
    {
        $positionUses = NULL;
        $sizes = NULL;
        $prices = NULL;
        $styles = NULL;
        $materials = NULL;
        $priceMinMax = NULL;

        $brands = \App\Product::getBrandFilter($params);
        if (isset($loadStyles['position_use'])) {
            $paramBrand = $params;
            $paramBrand['position_use'] = array_keys($loadStyles['position_use']);
            $positionUses = \App\Product::getPositionUseFilter($paramBrand);
        }
        if (isset($loadStyles['size'])) {
            $paramSize = $params;
            $paramSize['size'] = array_keys($loadStyles['size']);
            $sizes = \App\Product::getSizeFilter($paramSize);
        }
        if (isset($loadStyles['price'])) {
            $paramPrice = $params;
            $paramPrice['price'] = splitPrice($loadStyles['price']);
            $prices = \App\Product::getPriceFilter($paramPrice);
            $prices = array_filter((array)$prices, function($n) { 
                return $n > 0;
            });
            $priceMinMax = \App\Product::getMinMaxPriceFilter($params);
        }
        if (isset($loadStyles['style'])) {
            $paramStyle = $params;
            $paramStyle['style'] = array_keys($loadStyles['style']);
            $styles = \App\Product::getStyleFilter($paramStyle);
            $styles = array_filter((array)$styles, function($n) { 
                return $n > 0;
            });
        }
        if (isset($loadStyles['material'])) {
            $paramMaterial = $params;
            $paramMaterial['material'] = array_keys($loadStyles['material']);
            $materials = \App\Product::getMaterialFilter($paramMaterial);
            $materials = array_filter((array)$materials, function($n) { 
                return $n > 0;
            });
        }
        $colors = \App\Product::getColorFilter($params);
        return array(
            'brands' => $brands,
            'positionUses' => $positionUses,
            'sizes' => $sizes,
            'prices' => $prices,
            'colors' => $colors,
            'styles' => $styles,
            'materials' => $materials,
            'priceMinMax' => $priceMinMax,
        );
    }

    protected function getParamSearch($request, $params)
    {
        $brand = $request->get('brand', null);
        $pos = $request->get('pos', null);
        $size = $request->get('size', null);
        $color = $request->get('color', null);
        $price = $request->get('price', null);
        $kind = $request->get('kind', null);
        $material = $request->get('material', null);

        if ( ! empty($brand)) {
            $params['search_brand'] = urldecode($brand);
        }

        if ( ! empty($pos)) {
            $params['search_position_use'] = urldecode($pos);
        }

        if ( ! empty($size)) {
            $params['search_size'] = urldecode($size);
        }

        if ( ! empty($color)) {
            $params['search_color'] = urldecode($color);
        }

        if ( ! empty($price)) {
            $params['search_price'] = formatPriceQuery($price);
        }

        if ( ! empty($kind)) {
            $params['search_kind'] = urldecode($kind);
        }

        if ( ! empty($material)) {
            $params['search_material'] = urldecode($material);
        }

        return $params;
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
