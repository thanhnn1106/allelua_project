<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Seller\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Product;
use Auth;

class ProductController extends BaseController
{
    /**
     * Setting config as: rate and social
     * @param Request $request
     * @return type
     */
    public function index(Request $request)
    {
        $params = array(
            'language_code' => $this->lang,
            'user_id' => Auth::user()->id,
        );
        $products = Product::getListBySeller($params);

        return view('seller/product/list', [
            'products'          => $products,
        ]);
    }

    public function add(Request $request)
    {
        $langs = \App\Languages::getResults();
        $categories = \App\Categories::getRowByLang($this->lang);

        $productBestPrice = $this->loadProductBestPrice();
        $data = array(
            'languages' => $langs,
            'categories' => $categories,
            'product' => null,
            'productBestPrice' => $productBestPrice,
            'arrMenuBestPrice' => $this->loadMenuBestPrice($productBestPrice),
            'productWatched' => $this->loadProductWatched(),
        );

        return view('seller/product/form', $data);
    }

    public function edit(Request $request, $id)
    {
        $row = Product::find($id);
        if ($row === NULL) {
            return redirect(route('seller_product_index'));
        }
        if((int)$row->status !== config('product.product_seller_status.value.draft')) {
            $request->session()->flash('error', trans('common.seller.msg_not_permit_delete'));
            return redirect(route('seller_product_index'));
        }

        $langs = \App\Languages::getResults();
        $categories = \App\Categories::getRowByLang($this->lang);

        $productTrans = $row->productTranslates()->get();
        $groupProTrans = array();
        if(count($productTrans)) {
            foreach ($productTrans as $tran) {
                $groupProTrans[$tran->language_code] = $tran;
            }
        }
        $productImages = $this->loadImageDetails($row);

        $productBestPrice = $this->loadProductBestPrice();

        return view('seller/product/form', [
            'title'        => 'Edit',
            'product'      => $row,
            'productImages' => $productImages,
            'productTrans' => $groupProTrans,
            'languages' => $langs,
            'categories' => $categories,
            'productBestPrice' => $productBestPrice,
            'arrMenuBestPrice' => $this->loadMenuBestPrice($productBestPrice),
            'productWatched' => $this->loadProductWatched(),
        ]);
    }

    public function copy(Request $request, $id)
    {
        $product = Product::find($id);
        if($product === NULL) {
            return redirect(route('seller_product_index'));
        }

        DB::beginTransaction();

        try {
            $newProduct = $product->replicate();
            $randomStr = $this->randFolerProduct();
            $newPath   = $this->makePath(config('allelua.product_image.path_upload'), $randomStr, false);

            $urlImage = $this->copyImage($newProduct->image_rand, $newPath . DIRECTORY_SEPARATOR . 'thumb');
            if($urlImage !== false) {
                $this->resizeImage($urlImage);
                $newProduct->image_rand = $urlImage;
            }
            $newProduct->status = 0;
            $newProduct->push();

            //reset relations on EXISTING MODEL (this way you can control which ones will be loaded
            $product->relations = [];
            //load relations on EXISTING MODEL
            $product->load('productTranslates', 'productImages');
            //re-sync the child relationships
            $relations = $product->getRelations();
            foreach ($relations as $relation) {
                foreach ($relation as $relationRecord) {
                    $newRelationship = $relationRecord->replicate();
                    $newRelationship->product_id = $newProduct->id;
                    $urlImgDetail = $this->copyImage($newRelationship->image_rand, $newPath);
                    if($urlImgDetail !== false) {
                        $this->resizeImage($urlImgDetail, 'detail');
                        $newRelationship->image_rand = $urlImgDetail;
                    }
                    $newRelationship->push();
                }
            }

            DB::commit();

            $request->session()->flash('success', trans('common.seller.msg_post_product_success'));
            return redirect(route('seller_product_index'));

        } catch (\Exception $e) {
            var_dump($e->getMessage());exit;
            DB::rollback();
            $request->session()->flash('error', trans('common.msg_error_transaction'));
            return redirect(route('seller_product_index'));
        }
    }

    public function save(Request $request)
    {
        if (!$request->isMethod('post')) {
            return response()->json(array('error' => 1, 'result' => trans('common.msg_error_transaction')));
        }
        $productId = $request->get('product_id', NULL);
        $isEdit    = false;
        $imageRand = NULL;

        $randomStr = $this->randFolerProduct();
        $product = new Product();
        if(!empty($productId)) {
            $product = Product::find($productId);
            if($product === NULL) {
                return response()->json(array('error' => 1, 'result' => trans('common.msg_data_not_found')));
            }
            preg_match('/[A-Z|0-9]{6,}/', $product->image_rand, $matches);
            $randomStr = isset($matches[0]) ? $matches[0] : NULL;
            $isEdit = true;
            $imageRand = $product->image_rand;
        }

        // Check only post product when admin approve
        $personal = \App\Personal::where('user_id', Auth::user()->id)->where('status', 1)->first();
        if($personal === NULL) {
            return response()->json(array('error' => 1, 'result' => trans('common.msg_you_have_to_add_personal_info_before_post_product')));
        }

        // Set rules
        $rules = $this->setRules($request);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array('error' => 1, 'result' => trans('common.msg_please_check_form_below'), 'messages' => $validator->errors()), 422);
        }

        // Make path random
        $pathRand = $this->makePath(config('allelua.product_image.path_upload'), $randomStr, $isEdit);

        // Upload image thumb and details
        $imageThumb = NULL;
        if ($request->hasFile('image_thumb')) {
            $imageThumb = $this->uploadImage($request->file('image_thumb'), $pathRand . DIRECTORY_SEPARATOR . 'thumb');
            $this->resizeImage($imageThumb['rand_name']);
        }
        $imageDetail = array();
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $detail = $this->uploadImage($file, $pathRand);
                $imageDetail[] = $detail;
                $this->resizeImage($detail['rand_name'], 'detail');
            }
        }

        DB::beginTransaction();
        try {

            $rowProduct = $this->_saveProduct($request, $imageThumb, $product);

            // Write tag into image for search engine
            $this->setTagImage($request, $rowProduct);

            $this->_saveProductTrans($request, $rowProduct);

            $this->_saveProductImages($request, $imageDetail, $rowProduct);

            DB::commit();

            if($imageRand !== NULL && $imageThumb !== NULL) {
                $this->deleteImage(array('rand_name' => $imageRand));
            }

            $request->session()->flash('success', trans('common.seller.msg_post_product_success'));
            return response()->json(array('error' => 0, 'result' => route('seller_product_index')));

        } catch (\Exception $e) {
            DB::rollback();

            $this->deleteImage($imageThumb);
            $this->deleteImages($imageDetail);

            return response()->json(array('error' => 1, 'result' => trans('common.msg_error_transaction')));
        }
    }

    /**
     * Delete user with soft delete
     * 
     * @param Request $request
     * @param Integer $id user id
     * @todo delete file of product
     * @return type
     */
    public function delete(Request $request, $id) {
        $product = Product::where('id', $id)->where('user_id', Auth::user()->id)->first();
        if ($product == null) {
            $request->session()->flash('error', trans('common.msg_data_not_found'));

            return redirect(route('seller_product_index'));
        }
        /*
        if((int)$product->status !== config('product.product_seller_status.value.draft')) {
            $request->session()->flash('error', trans('front.product.not_permit_delete'));
            return redirect(route('seller_product_index'));
        }*/

        $product->delete();
        $request->session()->flash('success', trans('common.msg_delete_success'));

        return redirect(route('seller_product_index'));
    }

    private function _saveProduct($request, $imageThumb, $product)
    {
        $data = array(
            'category_id' => $request->get('categories'),
            'sub_category_id' => $request->get('sub_categories'),
            'user_id' => Auth::user()->id,
            'price' => $request->get('price'),
            'quantity' => $request->get('quantity'),
            'quantity_limit' => $request->get('quantity_limit'),
            'payment_method' => $request->get('payment_method'),
            'shipping_method' => $request->get('shipping_method'),
            'position_use' => $request->get('position_use'),
            'size' => $request->get('size'),
            'style' => $request->get('style'),
            'material' => $request->get('material'),
            'status' => $request->get('status'),
            'created_at' => date('Y-m-d H:i:s'),
        );
        if(isset($imageThumb['rand_name']) && $imageThumb['real_name']) {
            $data['image_rand'] = $imageThumb['rand_name'];
            $data['image_real'] = $imageThumb['real_name'];
        }
        foreach ($data as $key => $value) {
            $product->$key = $value;
        }
        $product->save();

        return $product;
    }

    private function _saveProductTrans($request, $product)
    {
        $data_default = $this->_setDefaultDataLang($request, $product);

        $langs = \App\Languages::getResults();
        foreach ($langs as $lang) {
            $row = $product->productTranslates()->where('language_code', $lang->iso2)->first();
            if($row === NULL) {
                $row = new \App\ProductTranslate();
            }
            if($lang->iso2 === $this->lang) {
                $data = $data_default;
            } else {
                $title = $request->get('title_'.$lang->iso2);
                $slug = str_slug($request->get('title_'.$lang->iso2));
                $tagImage = $request->get('tag_image_'.$lang->iso2);
                $color = $request->get('color_'.$lang->iso2);
                $branch = $request->get('brand_'.$lang->iso2);
                $infoTech = $request->get('info_tech_'.$lang->iso2);
                $featureHigh = $request->get('feature_highlight_'.$lang->iso2);
                $source = $request->get('source_'.$lang->iso2);
                $guarantee = $request->get('guarantee_'.$lang->iso2);
                $deliveryLocation = $request->get('delivery_location_'.$lang->iso2);
                $detail = $request->get('detail_'.$lang->iso2);
                $formProduct = $request->get('form_product_'.$lang->iso2);

                $data = array(
                    'product_id'           => $product->id,
                    'language_code'        => $lang->iso2,
                    'title'                => ( ! empty($title)) ? $title : $data_default['title'],
                    'slug'                 => ( ! empty($slug)) ? $slug : $data_default['slug'],
                    'tag_image'            => ( ! empty($tagImage)) ? $tagImage : $data_default['tag_image'],
                    'color'                => ( ! empty($color)) ? $color : $data_default['color'],
                    'brand'                => ( ! empty($branch)) ? $branch : $data_default['brand'],
                    'info_tech'            => ( ! empty($infoTech)) ? $infoTech : $data_default['info_tech'],
                    'feature_highlight'    => ( ! empty($featureHigh)) ? $featureHigh : $data_default['feature_highlight'],
                    'source'               => ( ! empty($source)) ? $source : $data_default['source'],
                    'guarantee'            => ( ! empty($guarantee)) ? $guarantee : $data_default['guarantee'],
                    'delivery_location'    => ( ! empty($deliveryLocation)) ? $deliveryLocation : $data_default['delivery_location'],
                    'detail'               => ( ! empty($detail)) ? $detail : $data_default['detail'],
                    'form_product'         => ( ! empty($formProduct)) ? $formProduct : $data_default['form_product'],
                    'created_at'           => date('Y-m-d H:i:s'),
                );
            }
            foreach ($data as $key => $value) {
                $row->$key = $value;
            }
            $row->save();
        }
    }

    private function _setDefaultDataLang($request, $product)
    {
        $data = array(
            'product_id'           => $product->id,
            'language_code'        => $this->lang,
            'title'                => $request->get('title_'.$this->lang),
            'slug'                 => str_slug($request->get('title_'.$this->lang)),
            'tag_image'                => $request->get('tag_image_'.$this->lang),
            'color'                => $request->get('color_'.$this->lang),
            'brand'                => $request->get('brand_'.$this->lang),
            'info_tech'            => $request->get('info_tech_'.$this->lang),
            'feature_highlight'    => $request->get('feature_highlight_'.$this->lang),
            'source'               => $request->get('source_'.$this->lang),
            'guarantee'            => $request->get('guarantee_'.$this->lang),
            'delivery_location'    => $request->get('delivery_location_'.$this->lang),
            'detail'               => $request->get('detail_'.$this->lang),
            'form_product'         => $request->get('form_product_'.$this->lang),
            'created_at'           => date('Y-m-d H:i:s'),
        );

        return $data;
    }

    private function _saveProductImages($request, $imageDetail, $product)
    {
        if(count($imageDetail)) {

            $total = 0;
            if ($product !== NULL) {
                $total = \App\ProductImage::where('product_id', $product->id)->count();
            }

            $data = array();
            foreach ($imageDetail as $index => $item) {

                $total += ($index + 1);

                $data[] = array(
                    'product_id' => $product->id,
                    'image_rand' => $item['rand_name'],
                    'image_real' => $item['real_name'],
                    'sort' => $total,
                    'created_at' => date('Y-m-d H:i:s'),
                );
            }
            \App\ProductImage::insert($data);
        }
        $sortDetail = $request->get('sortDetail');
        if (!empty($sortDetail) && $product !== NULL) {
            $arrDetail = explode(',', $sortDetail);
            foreach ($arrDetail as $index => $image_rand) {
                $row = \App\ProductImage::where('product_id', $product->id)->where('image_rand', $image_rand)->first();
                if ($row !== NULL) {
                    $row->sort = ($index + 1);
                    $row->save();
                }
            }
        }
    }
}
