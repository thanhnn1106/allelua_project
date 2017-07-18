<?php

use Illuminate\Database\Seeder;

use App\Statics;
use App\StaticsTranslate;

class StaticsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statics = [
            array(
                'status' => 1,
                'type' => 'type_1',
                'created_at' => date('Y-m-d H:i:s'),
                'translate' => array(
                    array(
                        'language_code' => 'vi',
                        'title' => 'Giới thiệu',
                        'slug' => 'gioi-thieu',
                    ),
                    array(
                        'language_code' => 'en',
                        'title' => 'About me',
                        'slug' => 'about-me',
                    ),
                )
            ),
            array(
                'status' => 1,
                'type' => 'type_2',
                'created_at' => date('Y-m-d H:i:s'),
                'translate' => array(
                    array(
                        'language_code' => 'vi',
                        'title' => 'Hướng dẫn mua hang',
                        'slug' => 'huong-dan-mua-hang',
                    ),
                    array(
                        'language_code' => 'en',
                        'title' => 'Hướng dẫn mua hang',
                        'slug' => 'huong-dan-mua-hang',
                    ),
                ),
            ),
            array(
                'status' => 1,
                'type' => 'type_3',
                'created_at' => date('Y-m-d H:i:s'),
                'translate' => array(
                    array(
                        'language_code' => 'vi',
                        'title' => 'Chính sách đổi trả',
                        'slug' => 'chinh-sach-doi-tra',
                    ),
                    array(
                        'language_code' => 'en',
                        'title' => 'Chính sách đổi trả',
                        'slug' => 'chinh-sach-doi-tra',
                    ),
                ),
            ),
            array(
                'status' => 1,
                'type' => 'type_4',
                'created_at' => date('Y-m-d H:i:s'),
                'translate' => array(
                    array(
                        'language_code' => 'vi',
                        'title' => 'Quy trình giải quyết tranh chap',
                        'slug' => 'qui-trinh-giai-quyet-tranh-chap',
                    ),
                    array(
                        'language_code' => 'en',
                        'title' => 'Quy trình giải quyết tranh chap',
                        'slug' => 'qui-trinh-giai-quyet-tranh-chap',
                    ),
                ),
            ),
            array(
                'status' => 1,
                'type' => 'type_5',
                'created_at' => date('Y-m-d H:i:s'),
                'translate' => array(
                    array(
                        'language_code' => 'vi',
                        'title' => 'Chính sách bảo hành',
                        'slug' => 'chinh-sach-bao-hang',
                    ),
                    array(
                        'language_code' => 'en',
                        'title' => 'Chính sách bảo hành',
                        'slug' => 'chinh-sach-bao-hang',
                    ),
                ),
            ),
            array(
                'status' => 1,
                'type' => 'type_6',
                'created_at' => date('Y-m-d H:i:s'),
                'translate' => array(
                    array(
                        'language_code' => 'vi',
                        'title' => 'Quy định và hình thức thanh toán',
                        'slug' => 'qui-dinh-va-hinh-thuc-thanh-toan',
                    ),
                    array(
                        'language_code' => 'en',
                        'title' => 'Quy định và hình thức thanh toán',
                        'slug' => 'qui-dinh-va-hinh-thuc-thanh-toan',
                    ),
                ),
            ),
            array(
                'status' => 1,
                'type' => 'type_7',
                'created_at' => date('Y-m-d H:i:s'),
                'translate' => array(
                    array(
                        'language_code' => 'vi',
                        'title' => 'Chính sách vận chuyển',
                        'slug' => 'chinh-sach-van-chuyen',
                    ),
                    array(
                        'language_code' => 'en',
                        'title' => 'Chính sách vận chuyển',
                        'slug' => 'chinh-sach-van-chuyen',
                    ),
                ),
            ),
            array(
                'status' => 1,
                'type' => 'type_8',
                'created_at' => date('Y-m-d H:i:s'),
                'translate' => array(
                    array(
                        'language_code' => 'vi',
                        'title' => 'Chính sách bảo mật thông tin khách hàng',
                        'slug' => 'chinh-sach-bao-mat-thong-tin-khach-hang',
                    ),
                    array(
                        'language_code' => 'en',
                        'title' => 'Chính sách bảo mật thông tin khách hàng',
                        'slug' => 'chinh-sach-bao-mat-thong-tin-khach-hang',
                    ),
                ),
            ),
            array(
                'status' => 1,
                'type' => 'type_9',
                'created_at' => date('Y-m-d H:i:s'),
                'translate' => array(
                    array(
                        'language_code' => 'vi',
                        'title' => 'Quy chế hoạt động',
                        'slug' => 'qui-che-hoat-dong',
                    ),
                    array(
                        'language_code' => 'en',
                        'title' => 'Quy chế hoạt động',
                        'slug' => 'qui-che-hoat-dong',
                    ),
                ),
            ),
        ];

        foreach ($statics as $static) {
            $chkStatic = Statics::where('type', $static['type'])->first();
            if ($chkStatic === NULL) {
                $objS = new Statics();
                $objS->status = $static['status'];
                $objS->type = $static['type'];
                $objS->created_at = $static['created_at'];
                $objS->save();
                if (isset($static['translate'])) {
                    foreach ($static['translate'] as $item) {
                        $obj = new StaticsTranslate();
                        $obj->static_id = $objS->id;
                        $obj->created_at = date('Y-m-d H:i:s');
                        $obj->title = $item['title'];
                        $obj->language_code = $item['language_code'];
                        $obj->slug = $item['slug'];
                        $obj->save();
                    }
                }
            }
        }
    }
}
