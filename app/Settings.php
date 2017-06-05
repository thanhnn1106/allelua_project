<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model  {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'settings';

    protected $primaryKey = 'key';

    public $incrementing = false;
}