<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Ajax\AjaxBaseController;
use Illuminate\Http\Request;
use App\Categories;

class UserController extends AjaxBaseController
{
    /**
     * Setting config as: rate and social
     * @param Request $request
     * @return type
     */
    public function loadSeller(Request $request)
    {
        try {
            $term = $request->get('term', NULL);
            if ($term === NULL) {
                return response()->json(array());
            }
            $sellers = \App\User::where('company_name', 'like', "{$term}%")->get();
            if ($sellers === NULL) {
                return response()->json(array());
            }
            $return = array();
            foreach ($sellers as $seller) {
                $return[] = array(
                    'id'    => $seller->id,
                    'value' => $seller->company_name,
                );
            }

            return response()->json($return);
        } catch (Exception $e) {
            return response()->json(array());
        }
    }
}
