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
        return $this->belongsTo('App\Users', 'user_id');
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

        $query->groupBy('t2.category_id')
                ->orderBy('t1.created_at', 'DESC');

        $result = $query->paginate(LIMIT_ROW);
        return $result;
    }
}
