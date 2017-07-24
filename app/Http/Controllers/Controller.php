<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getIso2Lang()
    {
        $langs = Languages::getResults();
        $langs = array_column($langs->toArray(), 'iso2');

        return $langs;
    }

    protected function uploadImage($file, $path)
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = uniqid().'.'.$extension;
        $file->move(public_path().$path, $fileName);

        return array(
            'rand_name' => $path . '/' . $fileName,
            'real_name' => $path . '/' . $file->getClientOriginalName(),
            'base_name' => $file->getClientOriginalName(),
        );
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
}
