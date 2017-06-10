<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Languages extends Model  {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'languages';

    public function categoryTranslates()
    {
        return $this->hasMany('App\CategoriesTranslate', 'language_code', 'iso2');
    }

    public function generals()
    {
        return $this->hasMany('App\Generals', 'language_code', 'iso2');
    }

    public function productTranslates()
    {
        return $this->hasMany('App\ProductTranslate', 'language_code', 'iso2');
    }
}