<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Product;

class ProductController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Setting config as: rate and social
     * @param Request $request
     * @return type
     */
    public function index(Request $request)
    {
        $products = Product::getList();
        return view('admin/product/list', [
            'products'      => $products,
        ]);
    }

    /**
     * Setting config as: rate and social
     * @param Request $request
     * @return type
     */
    public function listDeleted(Request $request)
    {
        $products = Product::getList(array('deleted_at_not_null' => true));
        return view('admin.product.list_deleted', [
            'products'      => $products,
        ]);
    }

    public function add(Request $request)
    {
        $langs = \App\Languages::getResults();
        $categories = \App\Categories::getRowByLang($this->lang);

        $data = array(
            'title'     => 'Add new',
            'languages' => $langs,
            'categories' => $categories,
            'product' => null,
        );

        return view('admin/product/form', $data);
    }

    public function edit(Request $request, $id)
    {
        $row = Product::find($id);
        if ($row === NULL) {
            return redirect(route('admin_product_index'));
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

        return view('admin/product/form', [
            'title'        => 'Edit',
            'product'      => $row,
            'productImages' => $productImages,
            'productTrans' => $groupProTrans,
            'languages' => $langs,
            'categories' => $categories,
            'company_name' => $row->user()->first()->company_name . ' (' . $row->user()->first()->email . ')',
        ]);
    }

    public function save(Request $request)
    {
        if (!$request->isMethod('post')) {
            return response()->json(array('error' => 1, 'result' => trans('common.msg_error_exception_ajax')));
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

            $request->session()->flash('success', trans('common.msg_save_success'));
            return response()->json(array('error' => 0, 'result' => route('admin_product_index')));

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
        $product = Product::find($id);
        if ($product == null) {
            $request->session()->flash('error', trans('common.msg_data_not_found'));
            return redirect(route('admin_product_index'));
        }

        $product->delete();
        $request->session()->flash('success', trans('common.msg_delete_success'));
        
        return redirect(route('admin_product_index'));
    }

    public function change(Request $request, $id) {
        $product = Product::find($id);
        if ($product == null) {
            $request->session()->flash('error', trans('common.msg_data_not_found'));
            return redirect(route('admin_product_index'));
        }

        if($product->status == 0) {
            $product->status = 1;
        } else {
            $product->status = 0;
        }
        $product->save();
        $request->session()->flash('success', trans('common.msg_save_success'));
        
        return redirect(route('admin_product_index'));
    }

    /**
     * Delete user with soft delete
     * 
     * @param Request $request
     * @param Integer $id user id
     * @todo delete file of product
     * @return type
     */
    public function restore(Request $request, $id) {
        $product = Product::onlyTrashed()->where('id', $id)->first();
        if ($product == null) {
            $request->session()->flash('error', trans('common.msg_data_not_found'));
            return redirect(route('admin_product_deleted_index'));
        }

        $product->restore();

        $request->session()->flash('success', trans('common.restore_success'));
        
        return redirect(route('admin_product_deleted_index'));
    }

    /**
     * Delete user with soft delete
     * 
     * @param Request $request
     * @param Integer $id user id
     * @todo delete file of product
     * @return type
     */
    public function deleteForce(Request $request, $id) {
        $product = Product::onlyTrashed()->where('id', $id)->first();
        if ($product == null) {
            $request->session()->flash('error', trans('common.msg_data_not_found'));
            return redirect(route('admin_product_deleted_index'));
        }

        // remove image before thumb
        $this->deleteImage(array('rand_name' => $product->image_rand));

        // remove image detail
        $images = $product->productImages();
        if($images !== NULL) {
            $imagedetails = array();
            foreach($images as $image) {
                $imagedetails[] = array('rand_name' => $image->image_rand);
            }
            $this->deleteImages($imagedetails);
        }

        $product->forceDelete();

        $request->session()->flash('success', trans('common.delete_force_success'));
        
        return redirect(route('admin_product_deleted_index'));
    }

    private function _saveProduct($request, $imageThumb, $product)
    {
        $data = array(
            'category_id' => $request->get('categories'),
            'sub_category_id' => $request->get('sub_categories'),
            'user_id' => $request->get('seller_id'),
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
        $langs = \App\Languages::getResults();
        foreach ($langs as $lang) {
            $row = $product->productTranslates()->where('language_code', $lang->iso2)->first();
            if($row === NULL) {
                $row = new \App\ProductTranslate();
            }
            $data = array(
                'product_id'           => $product->id,
                'language_code'        => $lang->iso2,
                'title'                => $request->get('title_'.$lang->iso2),
                'slug'                 => str_slug($request->get('title_'.$lang->iso2)),
                'tag_image'            => $request->get('tag_image_'.$lang->iso2),
                'color'                => $request->get('color_'.$lang->iso2),
                'brand'                => $request->get('brand_'.$lang->iso2),
                'info_tech'            => $request->get('info_tech_'.$lang->iso2),
                'feature_highlight'    => $request->get('feature_highlight_'.$lang->iso2),
                'source'               => $request->get('source_'.$lang->iso2),
                'guarantee'            => $request->get('guarantee_'.$lang->iso2),
                'delivery_location'    => $request->get('delivery_location_'.$lang->iso2),
                'detail'               => $request->get('detail_'.$lang->iso2),
                'form_product'         => $request->get('form_product_'.$lang->iso2),
                'created_at'           => date('Y-m-d H:i:s'),
            );
            foreach ($data as $key => $value) {
                $row->$key = $value;
            }
            $row->save();
        }
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
