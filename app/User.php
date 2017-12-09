<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\Notifications\sendEmailResetPassword;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name', 'email', 'password','phone_number', 'country_id', 'role_id', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function role()
    {
        return $this->belongsTo('App\Roles', 'role_id');
    }

    public function country()
    {
        return $this->belongsTo('App\Countries', 'country_id');
    }

    public function personal()
    {
        return $this->hasOne('App\Personal', 'user_id', 'id');
    }

    public function customerShippings()
    {
        return $this->hasMany('App\CustomerShipping', 'user_id', 'id');
    }

    public function products()
    {
        return $this->hasMany('App\Product', 'user_id', 'id');
    }

    public static function getListFilterUser($params) {
        $query = \DB::table('users AS t1')
                ->select('t1.*', 't2.role', 't3.name as country_name', 't4.id as personal_id')
                ->leftJoin('roles AS t2', 't2.id', '=', 't1.role_id')
                ->leftJoin('countries AS t3', 't3.id', '=', 't1.country_id')
                ->leftJoin('personal as t4', 't1.id', '=', 't4.user_id')
                ->whereNull('t1.deleted_at');

        self::query_params($query, $params);

        $query->orderBy('t1.created_at', 'DESC');

        $result = $query->paginate(LIMIT_ROW);
        return $result;
    }

    public static function query_params($query)
    {
        
    }

    public static function updateSellerPassword($id, $password)
    {
        $result = DB::table('users')
            ->where('id', '=', $id)
            ->update(array(
                'password' => bcrypt($password),
                'updated_at' => date('Y-m-d H:i:s'),
        ));
        return $result;
    }

    public static function getUserPersonalInfo()
    {
        $result = DB::table('users as u')
            ->select('u.id as user_id', 'u.company_name', 'p.id', 'p.status', 'p.tax_code', 'p.license_business', 'pb.account_bank', 'pb.name_bank', 'pb.address_bank', \DB::raw('GROUP_CONCAT(pt.introduce_company separator "|===|") as introduce_company'), \DB::raw('GROUP_CONCAT(pt.language_code separator "|===|") as langs'))
            ->join('personal as p', 'u.id', '=', 'p.user_id')
            ->join('personal_bank as pb', 'p.id', '=', 'pb.personal_id')
            ->join('personal_translate as pt', 'p.id', '=', 'pt.personal_id')
            ->where('u.role_id', '=', 2)
            ->groupby('u.id')
            ->orderby('p.created_at')
            ->get();
        return $result;
    }

    /**
     * Send link reset password. use App\Notifications\sendEmailResetPassword;
     *
     * @var array
     * @author Nguyen Ngoc Thanh <thanh.nn1106@gmail.com>
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new sendEmailResetPassword($token));
    }

    public static function getListUserDeleted() {
        $query = \DB::table('users AS t1')
                ->select('t1.*', 't2.role', 't3.name as country_name', 't4.id as personal_id')
                ->leftJoin('roles AS t2', 't2.id', '=', 't1.role_id')
                ->leftJoin('countries AS t3', 't3.id', '=', 't1.country_id')
                ->leftJoin('personal as t4', 't1.id', '=', 't4.user_id')
                ->whereNotNull('t1.deleted_at');


        $query->orderBy('t1.deleted_at', 'DESC');

        $result = $query->paginate(LIMIT_ROW);
        return $result;
    }

    public static function getUserDeletedInfo($id) {
        $query = \DB::table('users')
                ->select('*')
                ->where('id', $id)
                ->whereNotNull('deleted_at');


        $result = $query->first();
        return $result;
    }

    public static function restoreDeletedUser($id)
    {
        $result = DB::table('users')
            ->where('id', '=', $id)
            ->update(array(
                'deleted_at' => NULL,
                'updated_at' => date('Y-m-d H:i:s'),
        ));
        return $result;
    }

    public static function forceDeletedUser($id)
    {
        $result = DB::table('users')
            ->where('id', '=', $id)
            ->delete();
        return $result;
    }
}
