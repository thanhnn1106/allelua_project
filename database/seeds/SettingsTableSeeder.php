<?php

use Illuminate\Database\Seeder;
use App\Settings;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            array(
                'key'             => 'setting_rate',
                'value'           => 20000,
                'description'     => 'Rate 1 USD is 20.000 VND',
                'created_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'key'             => 'setting_link_facebook',
                'value'           => 'http://facebook.com/allelua',
                'description'     => 'Link social on facebook',
                'created_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'key'             => 'setting_link_zalo',
                'value'           => 'http://zalo.com/allelua',
                'description'     => 'Link social on zalo',
                'created_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'key'             => 'setting_link_youtube',
                'value'           => 'http://youtube.com/allelua',
                'description'     => 'Link social on youtube',
                'created_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'key'             => 'setting_link_twitter',
                'value'           => 'http://twitter.com/allelua',
                'description'     => 'Link social on Twitter',
                'created_at' => date('Y-m-d H:i:s'),
            ),
        ];

        foreach ($settings as $setting) {
            $chk = Settings::where('key', $setting['key'])->first();
            if ($chk === NULL) {
                DB::table('Settings')->insert($setting);
            }
        }
    }
}
