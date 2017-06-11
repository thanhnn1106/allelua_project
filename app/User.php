<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

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

    public function products()
    {
        return $this->hasMany('App\Product', 'user_id', 'id');
    }

    public static function getListFilterUser($params) {
        $query = \DB::table('users AS t1')
                ->select('t1.*', 't2.role', 't3.name as country_name')
                ->leftJoin('roles AS t2', 't2.id', '=', 't1.role_id')
                ->leftJoin('countries AS t3', 't3.id', '=', 't1.country_id')
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
}
