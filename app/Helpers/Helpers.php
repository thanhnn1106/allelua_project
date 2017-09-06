<?php
function asset_admin($path)
{
    return asset('admin/'.$path);
}
function asset_seller($path)
{
    return asset('seller/'.$path);
}
function asset_front($path)
{
    return asset('front/'.$path);
}

function getLogoImage($filePath)
{
    if(!empty($filePath) && file_exists(public_path().$filePath)) {
        return $filePath;
    }
    return '';
}
function getImage($fileRandPath, $fileRealPath)
{
    $result = array(
        'img_src' => NULL,
        'href'    => NULL,
        'base_name' => NULL,
    );
    if(!empty($fileRandPath) && file_exists(public_path().$fileRandPath)) {
        $result = array(
            'img_src' => $fileRandPath,
            'href'    => url($fileRandPath),
            'base_name' => basename($fileRealPath),
        );
        return $result;
    }
    return $result;
}

function format_type_product($str) {
    $unicode = array(
        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
        'd'=>'đ',
        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        'i'=>'í|ì|ỉ|ĩ|ị',
        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
        'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
        'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'D'=>'Đ',
        'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
        'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
    );

   foreach($unicode as $nonUnicode=>$uni){
        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
   }
   $str = str_replace('/', '', strtolower($str));
   $str = str_replace('(', '', strtolower($str));
   $str = str_replace(')', '', strtolower($str));
   $str = str_replace(' ', '_', strtolower($str));
   $str = str_replace(',', '', strtolower($str));
   $str = preg_replace('/[^A-Za-z0-9\_]/', '', $str);
   $str = preg_replace('/_+/', '_', $str);

   return $str;
}

function formatNumber($number)
{
    return number_format($number);
}

function getPaymentMethod($payment)
{
    $lists = config('product.payment_method.label');
    if(isset($lists[$payment])) {
        return trans($lists[$payment]);
    }
    return null;
}

function getShippingMethod($shipping)
{
    $lists = config('product.shipping_method.label');
    if(isset($lists[$shipping])) {
        return trans($lists[$shipping]);
    }
    return null;
}

function makeSlug($slug, $id = null, $isProduct = true)
{
    if ( ! empty($id)) {
        if ($isProduct) {
            $seoSlug = $slug.'-'.$id;
            return route('product_detail', ['slug' => $seoSlug]);
        }
        return route('product_load_sub_cate', ['slug' => $slug, 'id' => $id]);
    }

    return route('product_load_cate', ['slug' => $slug]);
}

function getIdFromSlug($slug_input) 
{
    $id = substr(strrchr($slug_input, "-"), 1);
    if (!is_numeric($id)) {
        return NULL;
    }
    return $id;
}

function formatPrice($number)
{
    $lang = \App::getLocale();

    if ($lang === 'en') {
        $rate = App\Settings::where('key', 'setting_rate')->first();
        if ($rate !== NULL) {
            $price = floor($number / $rate->value);
            return number_format($price) . ' $';
        }
    }
    return formatNumber($number) . ' đ';
}
function splitPrice($prices)
{
    $prices = array_keys($prices);
    if (empty($prices)) {
        return array();
    }

    $return = array();
    foreach ($prices as $price) {
        $keyTemp = $price;
        $return[$keyTemp] = formatPriceQuery($price);
//        if (preg_match('/^less_/', $price)) {
//            $return[$keyTemp] = str_replace('less_', ' <= ', $price);
//        } else if (preg_match('/^great_/', $price)) {
//            $return[$keyTemp] = str_replace('great_', ' >= ', $price);
//        } else {
//            $return[$keyTemp] = ' BETWEEN '.str_replace('_', ' AND ', $price);
//        }
    }
    return $return;
}

function formatPriceQuery($price)
{
    if (preg_match('/^less_/', $price)) {
        return str_replace('less_', ' <= ', $price);
    } else if (preg_match('/^great_/', $price)) {
        return str_replace('great_', ' >= ', $price);
    } else {
        return ' BETWEEN '.str_replace('_', ' AND ', $price);
    }
}

function formatPriceLang($price)
{
    $lang = \App::getLocale();

    if (preg_match('/^less_/', $price)) {
        $lbl = 'Dưới ';
        if ($lang === 'en') {
            $lbl = 'Under ';
        }
        $priceNew = str_replace('less_', '', $price);
        return $lbl.  formatPrice($priceNew);

    } else if (preg_match('/^great_/', $price)) {
        $lbl = 'Trên ';
        if ($lang === 'en') {
            $lbl = 'Over ';
        }
        $priceNew = str_replace('great_', '', $price);
        return $lbl.  formatPrice($priceNew);

    } else {
        $part = explode('_', $price);
        $min = formatNumber($part[0]);
        $max = formatNumber($part[1]);

        return $min . '-'. $max;
    }
}
function formatRouteSearch($params)
{
    $params = (array) $params;
    if (count($params)) {
        foreach ($params as $key => $param) {
            $params[$key] = urlencode($param);
        }
    }

    $brand = request()->get('brand');
    $positionUse = request()->get('pos');
    $color = request()->get('color');
    $kind = request()->get('kind');
    $material = request()->get('material');
    $price = request()->get('price');
    $size = request()->get('size');

    if ( ! empty($brand)) {
        $params['brand'] = $brand;
    }
    if ( ! empty($positionUse)) {
        $params['pos'] = $positionUse;
    }
    if ( ! empty($color)) {
        $params['color'] = $color;
    }
    if ( ! empty($kind)) {
        $params['kind'] = $kind;
    }
    if ( ! empty($material)) {
        $params['material'] = $material;
    }
    if ( ! empty($price)) {
        $params['price'] = $price;
    }
    if ( ! empty($size)) {
        $params['size'] = $size;
    }

    $currentRoute = \Route::currentRouteName();
    $routeParams = request()->route()->parameters;
    $routeParams = array_merge($routeParams, $params);

    return URL::route($currentRoute, $routeParams);
}

/**
 * 
 * @param string $dob
 * @param string $type: Y or m or d
 * @return type
 */
function getBirthDay($dob, $type = 'd')
{
    return $date = date($type, strtotime($dob));
}

function check_domain_name($url)
{
    $env = \App::environment();
    $domain = config('allelua.domain_name');
    if( ! isset($domain[$env])) {
        return false;
    }

    $info = parse_url($url);
    if(isset($info['host']) && in_array($info['host'], $domain[$env])) {
        return true;
    }
    return false;
}