<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
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

    public function productTranslates()
    {
        return $this->hasMany('App\ProductTranslate', 'product_id', 'id');
    }

    public static function getList($params = array()) {
        $query = \DB::table('products AS t1')
                ->select('t1.*', 't3.company_name', \DB::raw('GROUP_CONCAT(t2.title separator "|===|") as category_names'))
                ->leftJoin('categories_translate AS t2', 't2.category_id', '=', 't1.category_id')
                ->leftJoin('users AS t3', 't3.id', '=', 't1.user_id');
      
//        self::query_params($query, $params);

        $query->groupBy('t2.id')
                ->orderBy('t1.created_at', 'DESC');

        $result = $query->paginate(LIMIT_ROW);
        return $result;
    }

    public static function getProductFilter($params) {
        $query = \DB::table('products AS t1')
                ->select('t1.id', 't1.price', 't1.image_rand', 't1.image_real', 't2.title', 't2.slug')
                ->join('product_translate AS t2', 't2.product_id', '=', 't1.id')
                ->where('t1.status', 1);

        if( ! empty($params['language_code'])) {
            $query->where('t2.language_code', $params['language_code']);
        }
        if( ! empty($params['category_id'])) {
            $query->where('t1.category_id', $params['category_id']);
        }
        if( ! empty($params['sub_category_id'])) {
            $query->where('t1.sub_category_id', $params['sub_category_id']);
        }

        $result = $query->paginate(LIMIT_ROW);

        return $result;
    }

    public static function getProductWatched($lang) {
        $query = \DB::table('products AS t1')
                ->select('t1.id', 't1.price', 't1.image_rand', 't1.image_real', 't2.title', 't2.slug')
                ->join('product_translate AS t2', 't2.product_id', '=', 't1.id')
                ->where('t1.status', 1)
                ->where('t2.language_code', $lang)
                ->orderBy('t1.view_number', 'DESC')
                ->limit(20);

        return $query->get();
    }

    public static function getProductBestPrice($lang, $arrCateId) {
        $query = \DB::table('products AS t1')
                ->select('t1.id', 't1.category_id', 't1.price', 't1.image_rand', 't1.image_real', 't2.title', 't2.slug', 't3.title AS cate_title', 't3.slug AS cate_slug')
                ->join('product_translate AS t2', 't2.product_id', '=', 't1.id')
                ->leftJoin('categories_translate AS t3', 't3.id', '=', 't1.category_id')
                ->where('t1.status', 1)
                ->where('t2.language_code', $lang)
                ->whereIn('t1.category_id', $arrCateId)
                ->groupBy('t1.category_id')
                ->orderBy('t1.price', 'ASC')
                ->limit(20);

        return $query->get();
    }

    public static function getProductDetail($params) {
        $query = \DB::table('products AS t1')
                ->select('t1.id', 't1.category_id', 't1.sub_category_id', 't1.price', 't1.image_rand', 't1.image_real', 't1.payment_method', 't1.shipping_method', 't1.user_id',
                        't2.title', 't2.slug', 't2.brand', 't2.source', 't2.guarantee', 't2.delivery_location', 't2.detail',
                        't5.slug AS cate_slug', 't5.title AS cate_title', 't6.slug AS sub_cate_slug', 't6.title AS sub_cate_title')
                ->join('product_translate AS t2', 't2.product_id', '=', 't1.id')
                ->leftJoin('categories AS t3', 't3.id', '=', 't1.category_id')
                ->leftJoin('categories AS t4', 't4.id', '=', 't1.sub_category_id')
                ->leftJoin('categories_translate AS t5', 't3.id', '=', 't5.category_id')
                ->leftJoin('categories_translate AS t6', 't4.id', '=', 't6.category_id')
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
