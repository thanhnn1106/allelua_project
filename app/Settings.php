<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Settings extends Model  {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'settings';

    protected $primaryKey = 'key';

    public $incrementing = false;

    /**
     * get media link facebook, youtube, zalo....
     *
     * @return object $result
     * @auth Nguyen Ngoc Thanh <thanh.nn1106@gmai.com>
     */
    public static function getAllMediaLink()
    {
        $result = Settings::all();

        return $result->toArray();
    }
}