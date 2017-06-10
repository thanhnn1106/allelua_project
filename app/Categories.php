<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    public function subCategories()
    {
        return $this->hasMany('App\Categories', 'parent_id', 'id');
    }

    public function categoryTranslates()
    {
        return $this->hasMany('App\CategoriesTranslate', 'category_id', 'id');
    }

    public function products()
    {
        return $this->hasMany('App\Product', 'category_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\Categories', 'parent_id');
    }
}
