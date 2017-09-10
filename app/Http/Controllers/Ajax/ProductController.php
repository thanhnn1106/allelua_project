<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Ajax\AjaxBaseController;
use Illuminate\Http\Request;
use App\Categories;
use Auth;

class ProductController extends AjaxBaseController
{
    public function __construct() {
        parent::__construct();
    }

    /**
     * Setting config as: rate and social
     * @param Request $request
     * @return type
     */
    public function loadCategories(Request $request)
    {
        try {
            $categoryId = $request->get('categoryId', NULL);
            $subCateId = $request->get('subCategory', NULL);
            $html = '<option value="">------</option>';
            if (!empty($categoryId)) {
                $cates = Categories::getRowByLang($this->lang, $categoryId);
                if(count($cates)) {
                    foreach ($cates as $cate) {
                        $selected = '';
                        if($subCateId == $cate->id) {
                            $selected = 'selected="selected"';
                        }
                        $html .= '<option value="'.$cate->id.'" '.$selected.'>'.$cate->title.'</option>';
                    }
                }
            }

            return response()->json(array('error' => 0, 'result' => $html));
        } catch (Exception $e) {
            return response()->json(array('error' => 1, 'result' => trans('common.msg_error_exception_ajax')));
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

            $params = array(
                'positionUse' => $request->get('positionUse', NULL),
                'size' => $request->get('size', NULL),
                'style' => $request->get('style', NULL),
                'material' => $request->get('material', NULL),
            );
            $data = $this->getStyle($obj->type, $objSub->type);

            $roleAdmin = config('config.allelua.roles.administrator');
            if(Auth::user()->role_id === $roleAdmin) {
                $html = \View::make('ajax.product.style', array('data' => $data, 'params' => $params))->render();
            } else {
                $html = \View::make('ajax.product.seller_style', array('data' => $data, 'params' => $params))->render();
            }

            return response()->json(array('error' => 0, 'result' => $html));
        } catch (Exception $e) {
            return response()->json(array('error' => 1, 'result' => trans('common.msg_error_exception_ajax')));
        }
    }

    public function upload(Request $request)
    {
        try {
            if ($this->user === NULL) {
                return response()->json(array('error' => 1, 'result' => trans('freelancer.msg_data_not_found')));
            }

            $userId = $this->user->id;
            $params = array(
                'product_id' => $request->get('product_id'),
                'product_image_id' => $request->get('product_image_id'),
                'user_id' => $userId,
            );


            $msgJson = $this->checkUploadFile($request);
            if ($msgJson !== '') {
                return $msgJson;
            }

            $realPath = $randPath = array();
            $productImages = null;

            $arrFile = array();
            $arrDetail = array();
            $filePath = config('allelua.product_image.path_upload_detail');
            foreach ($request->file('files') as $file) {

                $uploaded = $this->uploadImage($file, $filePath);

                if ( ! empty($uploaded['rand_name'])) {
                    $arrFile[] = array(
                        'product_id' => $params['product_id'],
                        'product_image_id' => $params['product_image_id'],
                        'real_name' => $uploaded['real_name'],
                        'rand_name' => $uploaded['rand_name'],
                        'file' => url($uploaded['rand_name']),
                        'base_name' => $uploaded['base_name'],
                    );
                    if ($productImages !== null) {
                        $arrDetail[] = array(
                            'product_id' => $params['product_id'],
                            'image_rand' => $uploaded['rand_name'],
                            'image_rea' => $uploaded['real_name'],
                            'created_time' => date('Y-m-d H:i:s'),
                        );
                    }
                }
            }
            if (count($arrDetail)) {
                \App\ProductImage::insert($arrDetail);
            }

            if ( ! empty($params['product_id'])) {
                $productImages = \App\ProductImage::getImages($params);
                if ($productImages !== NULL) {
                    foreach ($productImages as $image) {
                        $realPath[] = $image->image_real;
                        $randPath[] = $image->image_rand;
                    }
                }
            }

            $urlDelete = route('ajax_product_delete_file');
            $arrReturn = $this->returnFormatFile($urlDelete, $arrFile);

            // When edit upload one file -> then merged image from DB + upload
            $arrReturn['realPath'] = array_merge($realPath, $arrReturn['realPath']);
            $arrReturn['randPath'] = array_merge($randPath, $arrReturn['randPath']);

            return response()->json($arrReturn);
        } catch (Exception $e) {
            return response()->json(array('error' => trans('common.msg_error_exception_ajax')));
        }
    }

    public function deleteFile(Request $request)
    {
        try {
            $params = array(
                'product_id' => $request->get('product_id'),
                'product_image_id' => $request->get('product_image_id'),
                'rand_name' => $request->get('rand_name'),
                'real_name' => $request->get('real_name'),
            );

            $productImage = \App\ProductImage::where('image_rand', $params['rand_name'])->where('product_id', $params['product_id'])->first();
            if ($productImage !== NULL) {
                $productImage->delete();
            }
            $this->removeFile($params['rand_name']);

            return response()->json(array());
        } catch (Exception $e) {
            return response()->json(array('error' => trans('common.msg_error_exception_ajax')));
        }
    }
}
