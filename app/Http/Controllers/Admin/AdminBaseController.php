<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class AdminBaseController extends Controller
{
    protected $lang;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->lang = \App::getLocale();
    }

    public function setRules($request)
    {
        $rules = $this->setGeneralRules($request);

        $rules = $this->setUploadRules($request, $rules);

        $rules = $this->setProductRules($request, $rules);

        return $rules;
    }

    protected function setGeneralRules($request)
    {
        $listStatus     = array_keys(config('product.product_status.label'));
        $listPayMethod  = array_keys(config('product.payment_method.label'));
        $listShipMethod = array_keys(config('product.shipping_method.label'));
        $cateId    = $request->get('categories');
        $subCateId = $request->get('sub_categories');

        $positionUses = $sizes = $styles = $material = '';
        $subCateRules = 'required|exists:categories,id';
        $objCate = \App\Categories::find($cateId);
        if ($objCate !== NULL) {
            if (in_array($objCate->type, config('product.cate_not_child'))) {
                $subCateRules = [];
            }

            $objSub = $objCate->subCategories()->find($subCateId);
            if ($objSub !== NULL) {
                $data = $this->getStyle($objCate->type, $objSub->type);
                if(isset($data['position_use'])) {
                    $positionUses = 'required|in:'.  implode(',', array_keys($data['position_use']));
                }
                if(isset($data['size'])) {
                    $sizes = 'required|in:'.  implode(',', array_keys($data['size']));
                }
                if(isset($data['style'])) {
                    $styles = 'required|in:'.  implode(',', array_keys($data['style']));
                }
                if(isset($data['material'])) {
                    $material = 'required|in:'.  implode(',', array_keys($data['material']));
                }
            }
        }

        $rules = array(
            'categories' => 'required|exists:categories,id,parent_id,NULL',
            'sub_categories'    => $subCateRules,
            'status'            => 'required|in:'.  implode(',', $listStatus),
            'price'             => 'required|numeric',
            'quantity'          => 'required|numeric|min:1',
            'quantity_limit'    => 'required|numeric|min:0|max:'.$request->get('quantity'),
            'position_use'      => $positionUses,
            'size'              => $sizes,
            'style'             => $styles,
            'material'          => $material,
            'seller_id'         => 'required|exists:users,id',
            'payment_method'    => 'required|in:'.implode(',', $listPayMethod),
            'shipping_method'   => 'required|in:'.implode(',', $listShipMethod),
        );

        return $rules;
    }

    protected function setUploadRules($request, $rules)
    {
        $fileTypes = config('product.file_accept_types');
        $maxImageDetail = config('product.max_image_detail');
        $minImageDetail = config('product.min_image_detail');

        $productId = $request->get('product_id', NULL);

        $required = 'required|';
        if(!empty($productId)) {
            $required = '';
        }

        $ruleImgs = array(
            'image_thumb' => $required.'max:2048|mimes:'.$fileTypes,
            'total_image_detail' => 'required|numeric|min:'.$minImageDetail.'|max:'.$maxImageDetail,
        );

        $rules = array_merge($rules, $ruleImgs);

        return $rules;
    }

    protected function setProductRules($request, $rules)
    {
        $langs = \App\Languages::getResults();
        foreach ($langs as $lang) {

            $rules['title_'.$lang->iso2] = 'required|max:255';
            $rules['color_'.$lang->iso2]  = 'max:255';
            $rules['brand_'.$lang->iso2]  = 'required|max:255';
            $rules['info_tech_'.$lang->iso2]  = 'max:255';
            $rules['feature_highlight_'.$lang->iso2]  = 'max:255';
            $rules['source_'.$lang->iso2]  = 'required|max:255';
            $rules['guarantee_'.$lang->iso2]  = 'max:255';
            $rules['delivery_location_'.$lang->iso2]  = 'required|max:255';
            $rules['detail_'.$lang->iso2]  = 'max:16777215';
            $rules['form_product_'.$lang->iso2]  = 'max:16777215';
        }
        return $rules;
    }

    protected function loadImageDetails($product)
    {
        if ($product === NULL) {
            return array();
        }

        $images = $product->productImages()->orderBy('sort', 'ASC')->get();
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

    protected function deleteImageThumb($imageThumb)
    {
        $filePath = isset($imageThumb['rand_name']) ?$imageThumb['rand_name'] : NULL;
        $this->removeFile($filePath);
    }

    protected function deleteImageDetail($imagedetails)
    {
        if(count($imagedetails)) {
            foreach ($imagedetails as $item) {
                $filePath = isset($item['rand_name']) ? $item['rand_name'] : NULL;
                $this->removeFile($filePath);
            }
        }
    }
}
