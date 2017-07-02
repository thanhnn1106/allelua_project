<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class PersonalTranslate extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'personal_translate';

    public function personal()
    {
        return $this->belongsTo('App\Personal', 'personal_id');
    }

    public static function addPersonalTranslate($params)
    {
        $response = false;
        $response = DB::table('personal_translate')->insert([
            'personal_id'       => $params['personal_id'],
            'language_code'     => 'vi',
            'introduce_company' => $params['introduce_company_vi'],
        ]);

        if ($response) {
            $response = DB::table('personal_translate')->insert([
                'personal_id'       => $params['personal_id'],
                'language_code'     => 'en',
                'introduce_company' => $params['introduce_company_en'],
            ]);
        }

        return $response;
    }

    public static function updatePersonalTranslate($params)
    {
        $response = false;
        $response = PersonalTranslate::where('personal_id', '=', $params['personal_id'])
            ->where('language_code', '=', 'en')
            ->update(array(
                'introduce_company' => $params['introduce_company_en'],
        ));

        if ($response) {
            $response = PersonalTranslate::where('personal_id', '=', $params['personal_id'])
                ->where('language_code', '=', 'vi')
                ->update(array(
                    'introduce_company' => $params['introduce_company_vi'],
            ));
        }

        return $response;
    }
}
