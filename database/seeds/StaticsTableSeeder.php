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
                        'title' => 'Hướng dẫn mua hàng',
                        'slug' => 'huong-dan-mua-hang',
                    ),
                    array(
                        'language_code' => 'en',
                        'title' => 'Purchase Instructions',
                        'slug' => 'purchase-instructions',
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
                        'title' => 'Replace – refund Policy',
                        'slug' => 'replace-refund-policy',
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
                        'title' => 'Quy trình giải quyết tranh chấp',
                        'slug' => 'quy-trinh-giai-quyet-tranh-chap',
                    ),
                    array(
                        'language_code' => 'en',
                        'title' => 'Dispute Settlement Process',
                        'slug' => 'dispute-settlement-process',
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
                        'slug' => 'chinh-sach-bao-hanh',
                    ),
                    array(
                        'language_code' => 'en',
                        'title' => 'Warranty Policy ',
                        'slug' => 'warranty-policy',
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
                        'slug' => 'quy-dinh-va-hinh-thuc-thanh-toan',
                    ),
                    array(
                        'language_code' => 'en',
                        'title' => 'Payment Method and Regulations',
                        'slug' => 'payment-method-and-regulations',
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
                        'title' => 'Shipping service',
                        'slug' => 'shipping-service',
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
                        'title' => 'Customer Privacy',
                        'slug' => 'customer-privacy',
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
                        'slug' => 'quy-che-hoat-dong',
                    ),
                    array(
                        'language_code' => 'en',
                        'title' => 'Operation Regulations',
                        'slug' => 'operation-regulations',
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
            } else {
                if(isset($static['translate'])) {
                    foreach ($static['translate'] as $trans) {
                        $row = StaticsTranslate::where('language_code', $trans['language_code'])->where('static_id', $chkStatic->id)->first();
                        if($row !== NULL) {
                            $row->title = $trans['title'];
                            $row->slug = $trans['slug'];
                            $row->save();
                        }
                    }
                }
            }
        }
    }
}
