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

    /**
     * Setting config as: rate and social
     * @param Request $request
     * @return type
     */
    public function loadSellerPersonal(Request $request)
    {
        try {
            $term = $request->get('term', NULL);
            if ($term === NULL) {
                return response()->json(array());
            }
            $sellers = \App\User::select('users.id as user_id', 'users.company_name', 'p.user_id as personal_user_id')
                ->where('company_name', 'like', "{$term}%")
                ->leftJoin('personal as p', 'p.user_id', 'users.id')
                ->get();
            if ($sellers === NULL) {
                return response()->json(array());
            }
            $return = array();
            foreach ($sellers as $seller) {
                if (!empty($seller->personal_user_id)) {
                    continue;
                }
                $return[] = array(
                    'id'    => $seller->user_id,
                    'value' => $seller->company_name,
                );
            }

            return response()->json($return);
        } catch (Exception $e) {
            return response()->json(array());
        }
    }
}
