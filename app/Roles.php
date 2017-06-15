<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model  {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    public function users()
    {
        return $this->hasMany('App\User', 'role_id', 'id');
    }

    public static function getRoles()
    {
        $roles = Roles::where('id', '!=', 1)->get(array('id', 'role'));

        return $roles;
    }
}