<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Languages;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getIso2Lang()
    {
        $langs = Languages::getResults();
        $langs = array_column($langs->toArray(), 'iso2');

        return $langs;
    }

    protected function randFolerProduct()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        $length = 6;
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    protected function resizeImage($path, $type = 'thumb')
    {
        $destPath = dirname($path);
        $ogImage  = public_path() . $path;

        list($width, $height) = getimagesize($ogImage);

        $baseName = basename($ogImage);

        if($type === 'detail') {
            $widthDefine = config('allelua.product_image.resize_detail_width');
            $heightDefine = config('allelua.product_image.resize_detail_height');
        } else {
            $widthDefine = config('allelua.product_image.resize_width');
            $heightDefine = config('allelua.product_image.resize_height');
        }

        $fileName = sprintf(config('allelua.product_image.resize_image'), $baseName);

        if($width < $widthDefine && $height < $heightDefine) {
            $image = new \Imagick( public_path() . $path );
            $image->writeImage(public_path() . $destPath . DIRECTORY_SEPARATOR . $fileName);
            $image->destroy();

            return $path;
        }

        $image = new \Imagick( public_path() . $path );
        $image->resizeImage($widthDefine, $heightDefine, \Imagick::FILTER_LANCZOS, 0.9, true);
        $image->writeImage(public_path() . $destPath . DIRECTORY_SEPARATOR . $fileName);
        $image->destroy();

        $path = public_path() . $destPath . DIRECTORY_SEPARATOR . $fileName;

        $this->autorotate($path);

        return $destPath . DIRECTORY_SEPARATOR . $fileName;
    }

    protected function autorotate($path)
    {
        $image = new \Imagick($path);
        switch ($image->getImageOrientation()) {

        case \Imagick::ORIENTATION_TOPRIGHT:
            $image->flopImage();
            break;
        case \Imagick::ORIENTATION_BOTTOMRIGHT:
            $image->rotateImage(new \ImagickPixel("#000"), 180);
            break;
        case \Imagick::ORIENTATION_BOTTOMLEFT:
            $image->flopImage();
            $image->rotateImage(new \ImagickPixel("#000"), 180);
            break;
        case \Imagick::ORIENTATION_LEFTTOP:
            $image->flopImage();
            $image->rotateImage(new \ImagickPixel("#000"), -90);
            break;
        case \Imagick::ORIENTATION_RIGHTTOP:
            $image->rotateImage(new \ImagickPixel("#000"), 90);
            break;
        case \Imagick::ORIENTATION_RIGHTBOTTOM:
            $image->flopImage();
            $image->rotateImage(new \ImagickPixel("#000"), 90);
            break;
        case \Imagick::ORIENTATION_LEFTBOTTOM:
            $image->rotateImage(new \ImagickPixel("#000"), -90);
            break;
        default: // Invalid orientation
            break;
        }
        $image->setImageOrientation(\Imagick::ORIENTATION_TOPLEFT);
        $image->writeImage();
        $image->destroy();

        return $image;
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

    protected function makePath($path, $random, $isEdit = false)
    {
        $pathRand = sprintf($path, $random);
        if (is_dir(public_path(). $pathRand) && $isEdit === false) {
            $random = $this->randFolerProduct();
            $this->makePath($path, $random, $isEdit);
        }
        return sprintf($path, $random);
    }

    protected function uploadImage($file, $path)
    {
        if ( ! is_dir(public_path(). $path)) {
            mkdir(public_path(). $path, 0777, true);
        }

        $extension = $file->getClientOriginalExtension();
        $fileName = uniqid().'.'.$extension;
        $file->move(public_path().$path, $fileName);

        $this->autorotate(public_path() . $path . DIRECTORY_SEPARATOR . $fileName);

        return array(
            'rand_name' => $path . '/' . $fileName,
            'real_name' => $path . '/' . $file->getClientOriginalName(),
            'base_name' => $file->getClientOriginalName(),
        );
    }

    protected function copyImage($oldImage, $newPath)
    {
        if(empty($oldImage) || ! file_exists(public_path() . $oldImage)) {
            return false;
        }
        if ( ! is_dir(public_path(). $newPath)) {
            mkdir(public_path(). $newPath, 0777, true);
        }

        $extension = \File::extension($oldImage);
        $fileName = uniqid().'.'.$extension;
        $newFilePath = $newPath . DIRECTORY_SEPARATOR . $fileName;

        $oldPath = public_path() . $oldImage;
        $newPathWithName = public_path() . $newFilePath;
        if (\File::copy($oldPath , $newPathWithName)) {
            return $newFilePath;
        }
        return false;
    }

    protected function setTagImage($request, $product)
    {
        if ($product === NULL) {
            return;
        }

        $randName = $product->image_rand;
        $path = dirname($randName);
        $baseName = basename($randName);
        $fileName = sprintf(config('allelua.product_image.resize_image'), $baseName);
        $filePath = $path . DIRECTORY_SEPARATOR . $fileName;

        $imagick = new \Imagick(public_path() . $filePath);
        $imagick1 = new \Imagick(public_path() . $randName);
        $langs = \App\Languages::getResults();
        $langDefault = \App::getLocale();

        $tagImageDefault = $request->get('tag_image_'.$langDefault);
        $arrData = array($langDefault => $tagImageDefault);

        foreach ($langs as $lang) {
            if($lang->iso2 !== $langDefault) {
                $temp = $request->get('tag_image_' . $lang->iso2);
                $tagImage = ( ! empty($temp)) ? $temp : $tagImageDefault;
                $arrData[$lang->iso2] = $tagImage;
            }
        }
        $imagick->commentimage(json_encode($arrData));
        $imagick->writeImage(public_path() . $filePath);
        $imagick1->commentimage(json_encode($arrData));
        $imagick1->writeImage(public_path() . $randName);
    }

    protected function returnFormatFile($urlDelete, $arrFile)
    {
        $p1 = $p2 = $realPath = $randPath = array();
        foreach ($arrFile as $item) {
            $key1 = $item['product_id'];
            $key2 = $item['product_image_id'];
            $realName = $item['base_name'];

            $linkFile = $item['file'];

            $realPath[] = $item['real_name'];
            $randPath[] = $item['rand_name'];
            $p1[] = $linkFile;
            $p2[] = [
                'caption' => $realName, 
                'url' => $urlDelete, 
                'key' => $key1, 
                'extra' => array(
                    'product_id' => $key1, 
                    'rand_name' => $item['rand_name'], 
                    'real_name' => $item['real_name'], 
                    'product_image_id' => $key2, 
                    '_token' => csrf_token()
                )
            ];
        }

        return [
            'initialPreview' => $p1, 
            'initialPreviewConfig' => $p2,
            'realPath' => $realPath,
            'randPath' => $randPath,
            'append' => true,
        ];
    }

    protected function removeFile($filePath) {
        if (file_exists(public_path() . $filePath)) {
            @unlink(public_path() . $filePath);
        }
    }

    protected function getStyle($cateType, $cateSubType = null)
    {
        $data = array();
        if ($cateType === 'gach_men') {
            $hasKey = \Config::has("product.{$cateType}");
            if (!$hasKey) {
                return '';
            }
            $data = config("product.{$cateType}");
        } else if ($cateSubType !== null) {
            $hasKey = \Config::has("product.{$cateType}.{$cateSubType}");
            if (!$hasKey) {
                return '';
            }
            $data = config("product.{$cateType}.{$cateSubType}");
            $hasMaterial = \Config::has("product.{$cateType}.{$cateSubType}.material");
            if ($hasMaterial) {
                $data['material'] = config("product.{$cateType}.{$cateSubType}.material");
            }
        }

        return $data;
    }

    protected function getPrice($data, $cateType, $cateSubType = null)
    {
        switch ($cateType) {
            case 'gach_men':
                $data['price'] = config('product.price_1');
                break;
            case 'may_cong_nghiep':
                if(empty($cateSubType)) {
                    $data['price'] = config('product.price_4');
                } else {
                    $data['price'] = config('product.price_4');
                }
                break;
            default:
                $data['price'] = config('product.price_3');
                break;
        }
        return $data;
    }

    protected function loadProductWatched($params = array())
    {
        $params['language_code'] = $this->lang;
        $userId = (Auth::check()) ? Auth::user()->id : NULL;
        $params['user_id'] = $userId;

        return \App\Product::getProductWatched($params);
    }

    protected function addProductWatched($product)
    {
        if($product === NULL || ! Auth::check()) {
            return;
        }

        $row = \App\ProductWatched::where('product_id', $product->id)->where('user_id', Auth::user()->id)->first();
        if($row === NULL) {
            $productWatched = new \App\ProductWatched();
            $productWatched->product_id = $product->id;
            $productWatched->user_id = Auth::user()->id;
            $productWatched->created_at = date('Y-m-d H:i:s');
            $productWatched->save();
        }
    }

    protected function loadProductRelated($id, $subCategoryId)
    {
        return \App\Product::getProductRelated($this->lang, $id, $subCategoryId);
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

    protected function getBirthDay()
    {
        $day = array('' => trans('front.register_page.dob.day'));
        for($i = 1; $i <= 31; $i++) {
            $j = $i;
            if($i < 10) {
                $j = '0'.$i;
            }
            $day[$j] = $j;
        }

        $month = array('' => trans('front.register_page.dob.month'));
        for($k = 1; $k <= 12; $k++) {
            $month[$k] = $k;
        }

        $year = array('' => trans('front.register_page.dob.year'));
        $currentYear = date('Y');
        for($m = 1900; $m < $currentYear; $m++) {
            $year[$m] = $m;
        }
        return array(
            'day' => $day,
            'month' => $month,
            'year' => $year,
        );
    }

    protected function deleteImage($imageThumb)
    {
        $filePath = isset($imageThumb['rand_name']) ? $imageThumb['rand_name'] : NULL;

        $path = dirname($imageThumb['rand_name']);
        $baseName = sprintf(config('allelua.product_image.resize_image'), basename($imageThumb['rand_name']));

        $this->removeFile($filePath);

        // Remove file resize
        $this->removeFile($path . DIRECTORY_SEPARATOR . $baseName);
    }

    protected function deleteImages($imagedetails)
    {
        if(count($imagedetails)) {
            foreach ($imagedetails as $item) {
                $filePath = isset($item['rand_name']) ? $item['rand_name'] : NULL;
                $path = dirname($item['rand_name']);
                $baseName = sprintf(config('allelua.product_image.resize_image'), basename($item['rand_name']));

                $this->removeFile($filePath);

                // Remove file resize
                $this->removeFile($path . DIRECTORY_SEPARATOR . $baseName);
            }
        }
    }

    protected function removeDirectory($path) {
 	$files = glob(public_path() . $path . '/*');
	foreach ($files as $file) {
            is_dir($file) ? $this->removeDirectory($file) : unlink($file);
	}
	rmdir(public_path(). $path);
 	return;
    }

}
