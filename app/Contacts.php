<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Contacts extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contacts';

    /**
     * get static page info list.
     *
     * @return object $result
     * @auth Nguyen Ngoc Thanh <thanh.nn1106@gmai.com>
     */
    public static function saveContact($params)
    {
        $response = DB::table('contacts')->insert([
            'email'   => $params['email'],
            'subject' => $params['subject'],
            'message' => $params['message'],
            'image'   => isset($params['image']) ? $params['image'] : '',
            'seen'  => '0',
            'status'  => '1',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return $response;
    }
}
