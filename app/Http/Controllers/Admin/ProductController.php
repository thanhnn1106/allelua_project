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

    public function edit(Request $request, $id, $parent_id)
    {
        $row = Categories::find($id);
        if ($row === NULL) {
            $request->session()->flash('error', trans('common.data_not_found'));
        }
        $rows = CategoriesTranslate::where('category_id', $id)->get();
        if ($rows === NULL) {
            $request->session()->flash('error', trans('common.data_not_found'));
        }
        $langs = $this->getLanguages();

        if ($request->isMethod('POST')) {

            $rules = array(
                'is_home' => 'in:1',
            );
            foreach ($langs as $lang) {
                $rules['title_'.$lang->iso2] = 'required|max:255';
            }

            // run the validation rules on the inputs from the form
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->route('admin_category_edit', array('id' => $id, 'parent_id' => $parent_id))
                            ->withErrors($validator)
                            ->withInput();
            }

            if (empty($parent_id)) {
                $row->is_home = $request->get('is_home');
                $row->save();
            }
            foreach ($langs as $lang) {
                $title       = $request->get('title_'.$lang->iso2);
                $slug        = formatSlug($title);

                $row = CategoriesTranslate::where('category_id', $id)->where('language_code', $lang->iso2)->first();
                if ($row !== null) {
                    $row->title       = $title;
                    $row->slug        = $slug;
                    $row->save();
                }
            }

            $request->session()->flash('success', trans('common.update_success'));
            if (empty($parent_id)) {
                return redirect(route('admin_category_main'));
            }
            return redirect(route('admin_category_sub', array('id' => $parent_id)));
        }

        return view('admin/category/form', [
            'categories'      => $rows,
            'category'        => $row,
            'id'              => $id,
            'languages'       => $langs,
            'parent_id'        => $parent_id
        ]);
    }

    /**
     * Delete user with soft delete
     * 
     * @param Request $request
     * @param Integer $id user id
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
