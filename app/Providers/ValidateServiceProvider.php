<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ValidateServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('unique_with', function ($attribute, $value, $parameters, $validator) {
             // remove first parameter and assume it is the table name
                $table = array_shift( $parameters );

                $fields = array();
                foreach ($parameters as $index => $item) {
                    if ($index == 0) {
                        $fields[$item] = $value;
                    } else {
                        $part = explode(':', $item);
                        if(preg_match('/<>/', $part[1])) {
                            $fields[$part[0]] = array('<>', str_replace('<>', '', $part[1]));
                        } else {
                            $fields[$part[0]] = $part[1];
                        }
                    }
                }
//echo '<pre>';
//                print_r($fields);exit;
                // query the table with all the conditions
                $result = \DB::table( $table )->select( \DB::raw( 1 ) );
                foreach ($fields as $key => $value) {
                    if(count($value) === 2) {
                        $result->where($key, $value[0], $value[1]);
                    } else {
                        $result->where($key, $value);
                    }
                }
                $row = $result->first();
                if ($row === NULL) {
                    return true;
                }
                return false;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
