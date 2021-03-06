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
                ->select('t1.id', 't1.is_home', 't1.sort', 't1.created_at', \DB::raw('GROUP_CONCAT(t2.title separator "|===|") as titles'), \DB::raw('GROUP_CONCAT(t2.language_code separator "|===|") as langs'))
                ->join('categories_translate AS t2', 't2.category_id', '=', 't1.id')
                ->whereNull('t1.parent_id')
                ->groupBy('t2.category_id')
                ->orderBy('t1.sort', 'ASC');

        $result = $query->get();
        return $result;
    }

    public static function getRowByLang($lang, $parentId = null) {
        $query = \DB::table('categories AS t1')
                ->select('t1.*', 't2.title', 't2.slug')
                ->join('categories_translate AS t2', 't2.category_id', '=', 't1.id')
                ->where('t2.language_code', $lang)
                ->orderBy('t1.sort', 'ASC');
        if ($parentId !== -1) {
            $query->where('t1.parent_id', $parentId);
        }

        $result = $query->get();
        return $result;
    }

    public static function getCategoryHome($lang, $parentId) {
        $query = \DB::table('categories AS t1')
                ->select('t1.*', 't2.title', 't2.slug')
                ->join('categories_translate AS t2', 't2.category_id', '=', 't1.id')
                ->where('t1.is_home', 1)
                ->where('t2.language_code', $lang)
                ->where('t1.parent_id', $parentId)
                ->orderBy('t1.sort', 'ASC');

        $result = $query->get();
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

    public static function getCateSubCate($lang, $slug, $cateId = NULL) {
        $select = array('t1.*', 't2.title', 't2.slug');
        if ( ! empty($cateId)) {
            $extend = array('t3.slug AS cate_slug', 't3.title AS cate_title', 't4.type AS cate_type');
            $select = array_merge($select, $extend);
        }
        $query = \DB::table('categories AS t1')
                ->select($select)
                ->join('categories_translate AS t2', 't2.category_id', '=', 't1.id')
                ->where('t2.language_code', $lang)
                ->where('t2.slug', $slug);
        if ( ! empty($cateId)) {
            $query->join('categories_translate AS t3', 't3.category_id', '=', 't1.parent_id')
                ->where('t1.id', $cateId)
                ->where('t3.language_code', $lang);
            $query->join('categories AS t4','t4.id', '=','t1.parent_id');
        }

        $row = $query->first();

        return $row;
    }
}
