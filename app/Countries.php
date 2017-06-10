<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Countries extends Model  {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'countries';

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }

    public static function getCountriesList()
    {
        $result = DB::table('countries')->select('*')->orderBy('id')->get();
        return $result;
    }
}