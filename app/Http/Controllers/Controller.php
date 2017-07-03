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

    protected function loadCategories()
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

        return $data;
    }
}
