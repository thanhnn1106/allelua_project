<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Personal extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'personal';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function personalTranslates()
    {
        return $this->hasMany('App\PersonalTranslate', 'personal_id', 'id');
    }

    public function personalBanks()
    {
        return $this->hasMany('App\PersonalBank', 'personal_id', 'id');
    }

    public static function updatePersonal($params)
    {
        $response = false;
        $response = Personal::where('user_id', '=', $params['user_id'])
            ->update(array(
                'tax_code'         => $params['tax_code'],
                'license_business' => $params['license_business'],
        ));

        if ($response) {
            $response = \App\Personal::where('user_id', '=', $params['user_id'])->first();
        }

        return $response;
    }

    public static function addPersonal($params)
    {
        $response = false;
        $response = DB::table('personal')->insert([
            'user_id'          => $params['seller_id'],
            'tax_code'         => $params['tax_code'],
            'license_business' => $params['license_business'],
        ]);

        if ($response) {
            $response = \App\Personal::where('user_id', '=', $params['seller_id'])->first();
        }

        return $response;
    }
    public static function getUserIdList()
    {
        $response = DB::table('personal')->select('user_id')->get()->toArray();

        return $response;
    }

}
