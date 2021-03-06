<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo('App\Categories', 'category_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function productImages()
    {
        return $this->hasMany('App\ProductImage', 'product_id', 'id');
    }

    public function productLikes()
    {
        return $this->hasMany('App\ProductLike', 'product_id', 'id');
    }

    public function productWatched()
    {
        return $this->hasMany('App\ProductWatched', 'product_id', 'id');
    }

    public function productTranslates()
    {
        return $this->hasMany('App\ProductTranslate', 'product_id', 'id');
    }

    public static function getListBySeller($params = array()) {
        $query = \DB::table('products AS t1')
                ->select('t1.*', 't2.title', 't2.slug', 't2.color', 't2.brand', 't2.info_tech', 't2.feature_highlight', 't2.source', 't2.guarantee',
                        't3.title AS category_title')
                ->leftJoin('product_translate AS t2', 't2.product_id', '=', 't1.id')
                ->leftJoin('categories_translate AS t3', function ($join) use ($params) {
                    $join->on('t3.category_id', '=', 't1.category_id');
                    if( ! empty($params['language_code'])) {
                        $join->where('t3.language_code', $params['language_code']);
                    }
                })->whereNull('t1.deleted_at');

        self::query_params($query, $params);

        $query->orderBy('t1.created_at', 'DESC');

        $result = $query->paginate(LIMIT_ROW);
        return $result;
    }

    public static function query_params($query, $params)
    {
        if ( ! empty($params['language_code'])) {
            $query->where('t2.language_code', $params['language_code']);
        }
        if ( ! empty($params['user_id'])) {
            $query->where('t1.user_id', $params['user_id']);
        }
    }

    public static function getList($params = array()) {
        $query = \DB::table('products AS t1')
                ->select('t1.*', 't3.company_name', \DB::raw('GROUP_CONCAT(t2.title separator "|===|") as category_names'))
                ->leftJoin('categories_translate AS t2', 't2.category_id', '=', 't1.category_id')
                ->leftJoin('users AS t3', 't3.id', '=', 't1.user_id');

        $deletedAtNotNull = isset($params['deleted_at_not_null']) ? $params['deleted_at_not_null'] : false;
        if($deletedAtNotNull === true) {
            $query->whereNotNull('t1.deleted_at');
        } else if ($deletedAtNotNull === false) {
            $query->whereNull('t1.deleted_at');
        }

        $query->groupBy('t1.id')
                ->orderBy('t1.created_at', 'DESC');

        $result = $query->paginate(LIMIT_ROW);
        return $result;
    }

    public static function getProductFilter($params) {
        $query = \DB::table('products AS t1')
                ->select('t1.id', 't1.price', 't1.image_rand', 't1.image_real', 't2.title', 't2.slug', 't1.category_id')
                ->join('product_translate AS t2', 't2.product_id', '=', 't1.id')
                ->where('t1.status', 1)
                ->whereNull('t1.deleted_at')
                ->orderBy('t1.created_at', 'DESC');

        self::_query_param($query, $params);

        $result = $query->paginate(LIMIT_ROW_AJAX);

        return $result;
    }

    public static function getCategoryMatchingSearch($params) {
        $query = \DB::table('products AS t1')
                ->select('t1.category_id', 't3.type', 't4.slug', \DB::raw('COUNT(t1.category_id) AS total'))
                ->join('product_translate AS t2', 't2.product_id', '=', 't1.id')
                ->join('categories AS t3', 't3.id', '=', 't1.category_id')
                ->join('categories_translate AS t4', 't4.category_id', '=', 't3.id')
                ->where('t1.status', 1)
                ->whereNull('t1.deleted_at')
                ->groupBy('t1.category_id')
                ->orderBy('total', 'DESC')
                ->limit(1);

        self::_query_param($query, $params);

        $result = $query->first();

        return $result;
    }

    public static function getBrandFilter($params)
    {
        $query = \DB::table('products AS t1')
                ->select('t2.brand', \DB::raw('COUNT(t1.id) AS total'))
                ->join('product_translate AS t2', 't2.product_id', '=', 't1.id')
                ->where('t1.status', 1)
                ->whereNull('t1.deleted_at')
                ->where('t2.brand', '!=', '')
                ->whereNotNull('t2.brand')
                ->groupBy('t2.brand');

        self::_query_param($query, $params);

        $result = $query->get();

        return $result;
    }

    public static function getPositionUseFilter($params)
    {
        $query = \DB::table('products AS t1')
                ->select('t1.position_use', \DB::raw('COUNT(t1.id) AS total'))
                ->join('product_translate AS t2', 't2.product_id', '=', 't1.id')
                ->where('t1.status', 1)
                ->whereNull('t1.deleted_at')
                ->groupBy('t1.position_use');

        self::_query_param($query, $params);

        $result = $query->get();

        return $result;
    }

    public static function getSizeFilter($params)
    {
        $query = \DB::table('products AS t1')
                ->select('t1.size', \DB::raw('COUNT(t1.id) AS total'))
                ->join('product_translate AS t2', 't2.product_id', '=', 't1.id')
                ->where('t1.status', 1)
                ->whereNull('t1.deleted_at')
                ->groupBy('t1.size');

        self::_query_param($query, $params);

        $result = $query->get();

        return $result;
    }

    public static function getColorFilter($params)
    {
        $query = \DB::table('products AS t1')
                ->select('t2.color', \DB::raw('COUNT(t1.id) AS total'))
                ->join('product_translate AS t2', 't2.product_id', '=', 't1.id')
                ->where('t1.status', 1)
                ->whereNull('t1.deleted_at')
                ->where('t2.color', '!=', '')
                ->whereNotNull('t2.color')
                ->groupBy('t2.color');

        self::_query_param($query, $params);

        $result = $query->get();

        return $result;
    }

    public static function getPriceFilter($params)
    {
        if (empty($params['price'])) {
            return array();
        }
        $select = array();
        foreach ($params['price'] as $key => $str) {
            $select[] = 'COUNT(CASE WHEN t1.price'.$str.' THEN 1 END) AS '.$key;
        }

        $query = \DB::table('products AS t1')
                ->select(\DB::raw(implode(',', $select)))
                ->join('product_translate AS t2', 't2.product_id', '=', 't1.id')
                ->where('t1.status', 1)
                ->whereNull('t1.deleted_at');

        self::_query_param($query, $params);

        $result = $query->first();

        return $result;
    }

    public static function getStyleFilter($params)
    {
        if (empty($params['style'])) {
            return array();
        }

        $select = array();
        foreach ($params['style'] as $itemKey) {
            $select[] = "COUNT(CASE WHEN t1.style = '".$itemKey."' THEN 1 END) AS {$itemKey}";
        }

        $query = \DB::table('products AS t1')
                ->select(\DB::raw(implode(',', $select)))
                ->join('product_translate AS t2', 't2.product_id', '=', 't1.id')
                ->where('t1.status', 1)
                ->whereNull('t1.deleted_at')
                ->where('t1.style', '<>', '')
                ->whereNotNull('t1.style');


        self::_query_param($query, $params);

        $result = $query->first();

        return $result;
    }

    public static function getMaterialFilter($params)
    {
        if (empty($params['material'])) {
            return array();
        }

        $select = array();
        foreach ($params['material'] as $itemKey) {
            $select[] = "COUNT(CASE WHEN t1.material = '".$itemKey."' THEN 1 END) AS {$itemKey}";
        }

        $query = \DB::table('products AS t1')
                ->select(\DB::raw(implode(',', $select)))
                ->join('product_translate AS t2', 't2.product_id', '=', 't1.id')
                ->where('t1.status', 1)
                ->whereNull('t1.deleted_at')
                ->where('t1.material', '<>', '')
                ->whereNotNull('t1.material')
                ->groupBy('t1.material');


        self::_query_param($query, $params);

        $result = $query->first();

        return $result;
    }

    public static function getMinMaxPriceFilter($params)
    {
        $query = \DB::table('products AS t1')
                ->select(\DB::raw("MAX(t1.price) AS maxPrice, MIN(t1.price) AS minPrice"))
                ->join('product_translate AS t2', 't2.product_id', '=', 't1.id')
                ->where('t1.status', 1)
                ->where('t1.price', '<>', '')
                ->whereNull('t1.deleted_at')
                ->whereNotNull('t1.price');


        self::_query_param($query, $params);

        $result = $query->first();

        return $result;
    }

    private static function _query_param($query, $params)
    {
        if( ! empty($params['language_code'])) {
            $query->where('t2.language_code', $params['language_code']);
        }
        if( ! empty($params['category_id'])) {
            $query->where('t1.category_id', $params['category_id']);
        }
        if( ! empty($params['sub_category_id'])) {
            $query->where('t1.sub_category_id', $params['sub_category_id']);
        }
        if( ! empty($params['brand'])) {
            $query->whereIn('t2.brand', (array) $params['brand']);
        }
        if( ! empty($params['position_use'])) {
            $query->whereIn('t1.position_use', (array) $params['position_use']);
        }
        if( ! empty($params['color'])) {
            $query->whereIn('t2.color', (array) $params['color']);
        }
        if( ! empty($params['size'])) {
            $query->whereIn('t1.size', (array) $params['size']);
        }

        // Filter
        if( ! empty($params['search_brand'])) {
            $query->where('t2.brand', $params['search_brand']);
        }
        if( ! empty($params['search_position_use'])) {
            $query->where('t1.position_use', $params['search_position_use']);
        }
        if( ! empty($params['search_size'])) {
            $query->where('t1.size', $params['search_size']);
        }
        if( ! empty($params['search_color'])) {
            $query->where('t2.color', $params['search_color']);
        }
        if( ! empty($params['search_price'])) {
            $query->whereRaw(\DB::raw("t1.price " . $params['search_price']));
        }
        if( ! empty($params['search_kind'])) {
            $query->where('t1.style', $params['search_kind']);
        }
        if( ! empty($params['search_material'])) {
            $query->where('t1.material', $params['search_material']);
        }

        if( ! empty($params['keyword'])) {
            $query->where('t2.title', 'LIKE', "%{$params['keyword']}%");
        }
        if( ! empty($params['tag_image'])) {
            $query->where('t2.tag_image', 'REGEXP', $params['tag_image']);
        }
    }

    public static function getProductWatched($params) {
        $query = \DB::table('products AS t1')
                ->select('t1.id', 't1.price', 't1.image_rand', 't1.image_real', 't2.title', 't2.slug', 't1.category_id')
                ->join('product_translate AS t2', 't2.product_id', '=', 't1.id')
                ->join('product_watched AS t3', 't3.product_id', '=', 't1.id')
                ->where('t1.status', 1)
                ->where('t2.language_code', $params['language_code'])
                ->where('t3.user_id', $params['user_id'])
                ->whereNull('t1.deleted_at');

        $result = $query->paginate(20);

        return $result;
    }

    public static function getProductRelated($lang, $id, $subCategoryId) {
        $query = \DB::table('products AS t1')
                ->select('t1.id', 't1.price', 't1.image_rand', 't1.image_real', 't2.title', 't2.slug')
                ->join('product_translate AS t2', 't2.product_id', '=', 't1.id')
                ->where('t1.status', 1)
                ->where('t2.language_code', $lang)
//                ->where('t1.sub_category_id', $subCategoryId)
                ->where('t1.id', '<>', $id)
                ->whereNull('t1.deleted_at')
                ->orderBy(\DB::raw("RAND()"))
                ->limit(20);
        if( ! empty($subCategoryId)) {
            $query->where('t1.sub_category_id', $subCategoryId);
        }

        return $query->get();
    }

    public static function getProductBestPrice($lang, $arrCateId = NULL) {
        $sub = \DB::table('products AS t1')
                ->select('t1.id', 't1.category_id', \DB::raw('MIN(t1.price) AS price'), 't1.image_rand', 't1.image_real', 't2.title', 't2.slug', 't3.title AS cate_title', 't3.slug AS cate_slug')
                ->join('product_translate AS t2', 't2.product_id', '=', 't1.id')
                ->leftJoin('categories_translate AS t3', 't3.id', '=', 't1.category_id')
                ->where('t1.status', 1)
                ->where('t2.language_code', $lang)
                ->whereNull('t1.deleted_at')
                ->groupBy('t2.product_id')
                ->orderBy('t1.price', 'ASC');

        if ( ! empty($arrCateId)) {
            $sub->whereIn('t1.category_id', (array) $arrCateId);
        }
        $query = \DB::table(\DB::raw('(' . $sub->toSql() . ')  as temp'))
            ->select('temp.*')
            ->mergeBindings($sub)
            ->groupBy('temp.category_id');

        return $query->get();
    }

    public static function getProductFavorites($params) {
        $query = \DB::table('products AS t1')
                ->select('t1.id', 't1.price', 't1.image_rand', 't1.image_real', 't2.title', 't2.slug', 't1.category_id')
                ->join('product_translate AS t2', 't2.product_id', '=', 't1.id')
                ->join('product_likes AS t3', 't3.product_id', '=', 't1.id')
                ->where('t1.status', 1);

        $query->where('t2.language_code', $params['language_code'])
                ->where('t3.user_id', $params['user_id']);

        $result = $query->paginate(LIMIT_ROW);

        return $result;
    }

    public static function getProductDetail($params) {
        $query = \DB::table('products AS t1')
                ->select('t1.id', 't1.category_id', 't1.sub_category_id', 't1.price', 't1.image_rand', 't1.image_real', 't1.payment_method', 't1.shipping_method', 't1.user_id', 't1.position_use', 't1.size', 't1.style', 't1.material',
                        't2.title', 't2.slug', 't2.brand', 't2.color', 't2.source', 't2.guarantee', 't2.delivery_location', 't2.detail', 't2.brand', 't2.info_tech', 't2.feature_highlight', 't2.detail', 't2.form_product',
                        't3.type as cate_type', 't4.type as subcate_type',
                        't5.slug AS cate_slug', 't5.title AS cate_title', 't6.slug AS sub_cate_slug', 't6.title AS sub_cate_title', 't1.quantity_limit AS product_quantity_limit' , 't1.quantity AS product_quantity',
                        't7.role_id AS user_role_id', 't7.status AS user_status')
                ->join('product_translate AS t2', 't2.product_id', '=', 't1.id')
                ->leftJoin('categories AS t3', 't3.id', '=', 't1.category_id')
                ->leftJoin('categories AS t4', 't4.id', '=', 't1.sub_category_id')
                //->leftJoin('categories_translate AS t5', 't3.id', '=', 't5.category_id')
				->leftJoin('categories_translate AS t5', function ($query) use ($params) {
					$query->on('t3.id', '=', 't5.category_id');
					if( ! empty($params['language_code'])) {
						$query->where('t5.language_code', $params['language_code']);
					}
				})
                ->leftJoin('categories_translate AS t6', function ($query) use ($params) {
					$query->on('t4.id', '=', 't6.category_id');
					if( ! empty($params['language_code'])) {
						$query->where('t6.language_code', $params['language_code']);
					}
				})
                ->leftJoin('users AS t7', 't1.user_id', '=', 't7.id')
                ->where('t1.status', 1);

        if( ! empty($params['product_id'])) {
            $query->where('t1.id', $params['product_id']);
        }
        if( ! empty($params['language_code'])) {
            $query->where('t2.language_code', $params['language_code']);
        }

        $row = $query->first();

        return $row;
    }

}
