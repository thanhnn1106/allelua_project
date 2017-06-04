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
                'seo_keyword'  => 'Gạch men, nhà cửa,...',
                'logo'         => 'xxx.jpg',
                'language_id'  => 1,
                'status'       => 1,
                'created_at'   => date('Y-m-d H:i:s'),
            ),
            array(
                'title'        => 'Title of website',
                'description'  => 'Description of website',
                'seo_keyword'  => 'Tone, Prenix...',
                'logo'         => 'xxx.jpg',
                'language_id'  => 2,
                'status'       => 1,
                'created_at'   => date('Y-m-d H:i:s'),
            )
        );
        $total = DB::table('generals')->count();
        if ($total === 0) {
            DB::table('generals')->insert($settings);
        }
    }
}
