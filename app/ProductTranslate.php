<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTranslate extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_translate';

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function language()
    {
        return $this->belongsTo('App\Languages', 'language_code');
    }
}
