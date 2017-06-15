<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Validator;
use App\Product;

class ProductController extends BaseController
{
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

    public function add(Request $request)
    {
        $langs = \App\Languages::getResults();
        $categories = \App\Categories::getRowByLang($this->lang);

        $data = array(
            'title'     => 'Add new',
            'languages' => $langs,
            'categories' => $categories,
        );

        return view('admin/product/form', $data);
    }

    public function edit(Request $request, $id)
    {
        $row = Product::find($id);
        if ($row === NULL) {
            $request->session()->flash('error', trans('common.data_not_found'));
        }

        return view('admin/product/form', [
            'product'      => $row,
            'title'        => 'Edit'
        ]);
    }

    public function save(Request $request)
    {
        
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
            $request->session()->flash('error', trans('common.data_not_found'));
            return redirect(route('admin_product_index'));
        }

        $product->delete();
        $request->session()->flash('success', trans('common.delete_success'));
        
        return redirect(route('admin_product_index'));
    }
}
