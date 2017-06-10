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
        return $this->belongsTo('App\Users', 'user_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
