<?php
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

function formatSlug($str) {
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
   $str = str_replace('(', '', strtolower($str));
   $str = str_replace(')', '', strtolower($str));
   $str = str_replace(' ', '-', strtolower($str));
   $str = str_replace(',', '-', strtolower($str));
   $str = preg_replace('/[^A-Za-z0-9\-]/', '', $str);
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