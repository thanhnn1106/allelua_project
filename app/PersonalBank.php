<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalBank extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'personal_bank';

    public function personal()
    {
        return $this->belongsTo('App\Personal', 'personal_id');
    }

    public static function updatePersonalBank($params)
    {
        $response = PersonalBank::where('personal_id', '=', $params['personal_id'])
            ->update(array(
                'account_bank' => $params['bank_account'],
                'name_bank'    => $params['bank_name'],
                'address_bank' => $params['bank_address'],
        ));

        return $response;
    }

}
