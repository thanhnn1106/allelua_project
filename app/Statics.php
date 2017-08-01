<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Statics extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'statics';

    public function staticTranslates()
    {
        return $this->hasMany('App\StaticsTranslate', 'static_id', 'id');
    }

    /**
     * get static page info list.
     *
     * @return object $result
     * @auth Nguyen Ngoc Thanh <thanh.nn1106@gmai.com>
     */
    public static function getPageInfoList()
    {
        $result = DB::table('statics as s')
            ->select('s.status', 's.id', 'st.title', \DB::raw('GROUP_CONCAT(st.slug separator "|===|") as slug'), \DB::raw('GROUP_CONCAT(st.content separator "|===|") as content'), \DB::raw('GROUP_CONCAT(st.language_code separator "|===|") as langs'))
            ->join('statics_translate as st', 's.id', '=', 'st.static_id')
            ->groupby('s.id')
            ->get();

        return $result;
    }

    /**
     * get static page info list.
     *
     * @return object $result
     * @auth Nguyen Ngoc Thanh <thanh.nn1106@gmai.com>
     */
    public static function getPageInfoListByLang($lang)
    {
        $result = DB::table('statics as s')
            ->select('s.type', 's.status', 's.id', 'st.title', 'st.slug')
            ->join('statics_translate as st', 's.id', '=', 'st.static_id')
            ->where('language_code', '=', $lang)
            ->groupby('s.id')
            ->get()
            ->toArray();

        return $result;
    }

}
