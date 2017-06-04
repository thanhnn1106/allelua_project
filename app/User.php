<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name', 'email', 'password',
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
        return $this->belongsTo('App\Models\Roles');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Countries');
    }

    public function language()
    {
        return $this->belongsTo('App\Models\Languages');
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
}
