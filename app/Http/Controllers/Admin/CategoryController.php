<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Validator;
use App\Categories;
use App\CategoriesTranslate;

class CategoryController extends BaseController
{
    /**
     * Setting config as: rate and social
     * @param Request $request
     * @return type
     */
    public function index(Request $request)
    {
        $totalSubs = Categories::getTotalSub();
        $totalSubs = json_decode(json_encode($totalSubs), true);
        if ($totalSubs !== NULL) {
            $totalSubs = array_column($totalSubs, 'total', 'id');
        }

        return view('admin/category/list', [
            'langs'           => $this->getLanguages(),
            'categories'      => Categories::getList(),
            'totalSubs'       => $totalSubs,
            'parent_id'       => 0,
        ]);
    }

    public function edit(Request $request, $id, $parent_id)
    {
        $rows = CategoriesTranslate::where('category_id', $id)->get();
        if ($rows === NULL) {
            $request->session()->flash('error', trans('common.data_not_found'));
        }
        $langs = $this->getLanguages();

        if ($request->isMethod('POST')) {

            $rules = array();
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
            'id'              => $id,
            'languages'       => $langs,
            'parent_id'        => $parent_id
        ]);
    }

    /**
     * Setting config as: rate and social
     * @param Request $request
     * @return type
     */
    public function sub(Request $request, $id)
    {
        return view('admin/category/list_sub', [
            'parent_id'       => $id,
            'langs'           => $this->getLanguages(),
            'categories'      => Categories::getListSub(array('parent_id' => $id)),
        ]);
    }

    public function sort(Request $request)
    {
        $ids = $request->get('ids');
        $sorts = $request->get('sort');
        $parentId = $request->get('parent_id');
        if (is_array($ids)) {
            foreach ($ids as $key => $id) {
                $row = Categories::find($id);
                if ($row !== NULL) {
                    $sort = $sorts[$key];
                    $row->sort = $sort;
                    $row->save();
                }
            }
            $request->session()->flash('success', trans('common.update_success'));
        }
        if (empty($parentId)) {
            return redirect(route('admin_category_main'));
        }
        return redirect(route('admin_category_sub', array('id' => $parentId)));
    }
}
