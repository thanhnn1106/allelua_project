<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_images';

    public function category()
    {
        return $this->belongsTo('App\Categories', 'category_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

    public static function getImages($params)
    {
        $query = \DB::table('product_images AS t1')
                ->select('t1.*')
                ->join('products AS t2', 't2.id', '=', 't1.product_id');

        self::query_params($query, $params);

        $result = $query->get();

        return $result;
    }

    public static function getTotalImage($params)
    {
        $query = \DB::table('product_images AS t1')
                ->join('products AS t2', 't2.id', '=', 't1.product_id');

        self::query_params($query, $params);

        $result = $query->count();

        return $result;
    }

    public static function query_params($query, $params)
    {
        if ( ! empty($params['product_id'])) {
            $query->where('t1.product_id', $params['product_id']);
        }
        if ( ! empty($params['user_id'])) {
            $query->where('t2.user_id', $params['user_id']);
        }
    }
}
