<?php

use Illuminate\Database\Seeder;
use App\Generals;

class GeneralsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = array(
            array(
                'title'        => 'Title cua website',
                'description'  => 'Description cua website',
                'seo_keyword'  => 'Gạch men,nhà cửa,...',
                'logo'         => null,
                'language_code'  => 'vi',
                'created_at'   => date('Y-m-d H:i:s'),
            ),
            array(
                'title'        => 'Title of website',
                'description'  => 'Description of website',
                'seo_keyword'  => 'Tone,Prenix...',
                'logo'         => null,
                'language_code'  => 'en',
                'created_at'   => date('Y-m-d H:i:s'),
            )
        );
        $total = DB::table('generals')->count();
        if ($total === 0) {
            DB::table('generals')->insert($settings);
        }
    }
}
