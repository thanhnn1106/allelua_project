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

    public static function getList($params = array()) {
        $query = \DB::table('categories AS t1')
                ->select('t1.id', 't1.sort', 't1.created_at', \DB::raw('GROUP_CONCAT(t2.title separator "|===|") as titles'), \DB::raw('GROUP_CONCAT(t2.language_code separator "|===|") as langs'))
                ->join('categories_translate AS t2', 't2.category_id', '=', 't1.id')
                ->whereNull('t1.parent_id')
                ->groupBy('t2.category_id')
                ->orderBy('t1.sort', 'ASC');

        $result = $query->get();
        return $result;
    }

    public static function getRowByLang($lang, $isParent = null) {
        $query = \DB::table('categories AS t1')
                ->select('t1.*', 't2.title', 't2.slug')
                ->join('categories_translate AS t2', 't2.category_id', '=', 't1.id')
                ->where('t2.language_code', $lang)
                ->orderBy('t1.sort', 'ASC');

        $result = $query->get()->toArray();
        return $result;
    }

    public static function getListSub($params = array()) {
        $query = \DB::table('categories AS t1')
                ->select('t1.id', 't1.sort', 't1.created_at', \DB::raw('GROUP_CONCAT(t2.title separator "|===|") as titles'), \DB::raw('GROUP_CONCAT(t2.language_code separator "|===|") as langs'))
                ->join('categories_translate AS t2', 't2.category_id', '=', 't1.id');
        if (isset($params['parent_id'])) {
            $query->where('t1.parent_id', $params['parent_id']);
        }
        $query->groupBy('t2.category_id')
                ->orderBy('t1.sort', 'ASC');

        $result = $query->get();
        return $result;
    }

    public static function getTotalSub() {
        $query = \DB::table('categories AS t1')
                ->select('t1.id', \DB::raw('COUNT(t1.id) as total'))
                ->join('categories AS t2', 't2.parent_id', '=', 't1.id')
                ->groupBy('t1.id');

        $result = $query->get();
        return $result;
    }
}
