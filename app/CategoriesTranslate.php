<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriesTranslate extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories_translate';

    public function category()
    {
        return $this->belongsTo('App\Categories', 'category_id');
    }

    public function language()
    {
        return $this->belongsTo('App\Languages', 'language_code');
    }
}
