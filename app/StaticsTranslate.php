<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class StaticsTranslate extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'statics_translate';

    public function product()
    {
        return $this->belongsTo('App\Statics', 'static_id');
    }

    public function language()
    {
        return $this->belongsTo('App\Languages', 'language_code');
    }

    /**
     * Update static page content.
     *
     * @return boolean $response
     * @auth Nguyen Ngoc Thanh <thanh.nn1106@gmai.com>
     */
    public static function updateStaticsTranslate($postData)
    {
        $response = false;
        $response = StaticsTranslate::where('static_id', '=', $postData['page_id'])
            ->where('language_code', '=', 'en')
            ->update(array(
                'content' => $postData['content_en'],
        ));

        if ($response) {
            $response = StaticsTranslate::where('static_id', '=', $postData['page_id'])
                ->where('language_code', '=', 'vi')
                ->update(array(
                    'content' => $postData['content_vi'],
            ));
        }

        return $response;
    }

    /**
     * Get static page content.
     *
     * @return boolean $response
     * @auth Nguyen Ngoc Thanh <thanh.nn1106@gmai.com>
     */
    public static function getStaticsTranslateBySlug($slug)
    {
        $result = DB::table('statics_translate')
            ->select('content', 'title')
            ->where('slug', '=', $slug)
            ->first();

        return $result;
    }
}
