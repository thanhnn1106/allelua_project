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
}
