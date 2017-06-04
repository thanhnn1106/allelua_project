<?php

use Illuminate\Database\Seeder;
use App\Languages;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $langs = array(
            array(
                'iso2'        => 'vi',
                'name'        => 'Tiếng việt',
                'created_at'  => date('Y-m-d H:i:s'),
            ),
            array(
                'iso2'        => 'en',
                'name'        => 'English',
                'created_at'  => date('Y-m-d H:i:s'),
            )
        );
        foreach ($langs as $lang) {
            $row = Languages::where('iso2', $lang['iso2'])->first();
            if ($row === null) {
                DB::table('languages')->insert($lang);
            }
        }
    }
}
