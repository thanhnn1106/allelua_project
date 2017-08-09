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
     * get contact list.
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
            'status'  => '0',
            'created_at' => date(DATETIME_FORMAT),
        ]);

        return $response;
    }

    /**
     * get update contact.
     *
     * @return object $result
     * @auth Nguyen Ngoc Thanh <thanh.nn1106@gmai.com>
     */
    public static function updateContact($params)
    {
        $response = DB::table('contacts')
                ->where('id', '=', $params['contact_id'])
                ->update([
                    'noted'      => (isset($params['noted'])) ? $params['noted'] : '',
                    'status'     => $params['status'],
                    'updated_at' => date(DATETIME_FORMAT),
                ]);

        return $response;
    }
}
