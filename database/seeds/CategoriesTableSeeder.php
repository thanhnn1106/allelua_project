<?php

use Illuminate\Database\Seeder;

use App\Categories;
use App\CategoriesTranslate;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array(
            array(
                'label' => 'Gạch men',
                'sort' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'childs' => array(
                    array(
                        'label' => 'Gạch lát nền',
                        'sort' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Gạch ốp tường',
                        'sort' => 2,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Gạch viền',
                        'sort' => 3,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Gạch điểm',
                        'sort' => 4,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Gạch trang trí',
                        'sort' => 5,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Gạch bông gió',
                        'sort' => 6,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                ),
            ),
            array(
                'label' => 'Thiết Bị Vệ Sinh',
                'sort' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'childs' => array(
                    array(
                        'label' => 'Bàn Cầu / Bệt Toilet',
                        'sort' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Chậu Lavabo',
                        'sort' => 2,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Vòi Chậu - Vòi Bồn',
                        'sort' => 3,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Sen Tắm',
                        'sort' => 4,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Bồn Tắm',
                        'sort' => 5,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Bồn Tiểu',
                        'sort' => 6,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Van Xả Tiểu - Xả Toilet',
                        'sort' => 7,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Phòng Tắm',
                        'sort' => 8,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Nắp Bàn Cầu',
                        'sort' => 9,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Phụ kiện nhà tắm',
                        'sort' => 10,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                ),
            ),
            array(
                'label' => 'Thiết bị chiếu sáng',
                'sort' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'childs' => array(
                    array(
                        'label' => 'Đèn phòng khách',
                        'sort' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Đèn Phòng Tắm',
                        'sort' => 2,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Đèn Phòng ngủ',
                        'sort' => 3,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Đèn Bàn',
                        'sort' => 4,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Đèn Trần Chiếu Điểm',
                        'sort' => 5,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Đèn Ngoài Sân Vườn',
                        'sort' => 6,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Bóng Chiếu Sáng Tiết Kiệm',
                        'sort' => 7,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Chóa Đèn',
                        'sort' => 8,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Công Tắc',
                        'sort' => 8,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Thiết Bị Đóng Cắt',
                        'sort' => 9,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Ổ Cấm',
                        'sort' => 10,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Chiết Áp Đèn',
                        'sort' => 11,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Giải Pháp Khách Sạn',
                        'sort' => 12,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Hệ Thống Kết Nối',
                        'sort' => 13,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Cảm Biến Ánh Sáng',
                        'sort' => 14,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Thiết Bị Ngoại Vi',
                        'sort' => 15,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Điều Tốc Quạt',
                        'sort' => 16,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Đèn Sạc LED',
                        'sort' => 17,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                ),
            ),
            array(
                'label' => 'Nội Thất',
                'sort' => 4,
                'created_at' => date('Y-m-d H:i:s'),
                'childs' => array(
                    array(
                        'label' => 'Nội Thất Văn phòng',
                        'sort' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Nội Thất Phòng Khách',
                        'sort' => 2,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Nội Thất Phòng Ngủ',
                        'sort' => 3,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Nội thất nhà Bếp',
                        'sort' => 4,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Đồ trang trí',
                        'sort' => 4,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Tranh treo tường',
                        'sort' => 4,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                ),
            ),
            array(
                'label' => 'Đồ gia dụng',
                'sort' => 5,
                'created_at' => date('Y-m-d H:i:s'),
                'childs' => array(
                    array(
                        'label' => 'Dụng cụ làm đồ ăn',
                        'sort' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Tắm Nước Nóng',
                        'sort' => 2,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Hút Bụi',
                        'sort' => 3,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Pha Cà Phê',
                        'sort' => 4,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Bàn Ủi',
                        'sort' => 5,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Cây Nước Nóng Lạnh',
                        'sort' => 6,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Nồi Cơm Điện',
                        'sort' => 7,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Hút Ẩm',
                        'sort' => 8,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Nướng Bánh Mì',
                        'sort' => 9,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Quạt',
                        'sort' => 10,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Đánh Sữa',
                        'sort' => 11,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Xay Sinh Tố',
                        'sort' => 12,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Xay Đa Năng Cầm Tay',
                        'sort' => 13,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Ép Trái Cây',
                        'sort' => 13,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Xay Thức Ăn',
                        'sort' => 14,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Nồi Nấu Lẩu',
                        'sort' => 15,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Nồi Áp Suất',
                        'sort' => 16,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Hấp Thức Ăn',
                        'sort' => 17,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Sưởi - Quạt Sưởi',
                        'sort' => 18,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Sấy Tóc',
                        'sort' => 19,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Nồi Chiên Chân Không',
                        'sort' => 20,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Ấm Đun Nước - Pha Trà',
                        'sort' => 21,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Trộn Thức Ăn',
                        'sort' => 22,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Lọc Nước',
                        'sort' => 23,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Làm Sữa Chua',
                        'sort' => 24,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Tạo Ozones',
                        'sort' => 25,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Làm Rau Mầm',
                        'sort' => 26,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Xay Sữa Đậu Nành',
                        'sort' => 27,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Lọc Không Khí',
                        'sort' => 28,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Làm Mì',
                        'sort' => 29,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Cạo Râu',
                        'sort' => 30,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Làm Bánh',
                        'sort' => 31,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Cắt Rau Củ Và Làm Kem',
                        'sort' => 32,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                ),
            ),
            array(
                'label' => 'Thiết Bị Nhà Bếp',
                'sort' => 6,
                'created_at' => date('Y-m-d H:i:s'),
                'childs' => array(
                    array(
                        'label' => 'Máy Hút Khói',
                        'sort' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Bếp Lắp Âm',
                        'sort' => 2,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Lò Lắp Âm',
                        'sort' => 3,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Tủ Rượu Vang',
                        'sort' => 4,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Hủy Thực Phẩm Thừa',
                        'sort' => 5,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Chậu Bếp / Chậu Rửa Chén',
                        'sort' => 6,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Rửa Chén',
                        'sort' => 7,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Sấy Chén',
                        'sort' => 8,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Bếp Đặt Bàn',
                        'sort' => 9,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Lò Nướng',
                        'sort' => 10,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Lò Vi Sóng Đặt Bàn',
                        'sort' => 11,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Dung Dịch Tẩy Rửa',
                        'sort' => 12,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Phụ Kiện Bếp',
                        'sort' => 13,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Kệ',
                        'sort' => 14,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Thùng Gạo',
                        'sort' => 15,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Thùng rác',
                        'sort' => 16,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                ),
            ),
            array(
                'label' => 'Thiết bị văn phòng',
                'sort' => 7,
                'created_at' => date('Y-m-d H:i:s'),
                'childs' => array(
                    array(
                        'label' => 'Máy Chấm Công',
                        'sort' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Photocopy',
                        'sort' => 2,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Điện Thoại – Fax',
                        'sort' => 3,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy In',
                        'sort' => 4,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Scan',
                        'sort' => 5,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Huỷ Giấy - Huỷ Tài Liệu',
                        'sort' => 6,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Tính Bàn (Computer)',
                        'sort' => 7,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Màn Hình Máy Tính',
                        'sort' => 8,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Hộp Mực In (Cartridge)',
                        'sort' => 9,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Chiếu (Projector)',
                        'sort' => 10,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Phụ Kiện Máy Chiếu',
                        'sort' => 11,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Đếm Tiền',
                        'sort' => 12,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Bảng Viết Flipchart',
                        'sort' => 13,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Cắt Giấy',
                        'sort' => 14,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Bảng Tương Tác',
                        'sort' => 15,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Bó Tiền',
                        'sort' => 16,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Kiểm Tra Tiền',
                        'sort' => 17,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                ),
            ),
            array(
                'label' => 'Thiết bị ngành nước',
                'sort' => 8,
                'created_at' => date('Y-m-d H:i:s'),
                'childs' => array(
                    array(
                        'label' => 'Ống nước',
                        'sort' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Phụ kiện ống nước',
                        'sort' => 2,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy Bơm',
                        'sort' => 3,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Hệ thống xử lý nước',
                        'sort' => 4,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Máy phun rửa áp lực',
                        'sort' => 5,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Đồng hồ nước',
                        'sort' => 6,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Phụ kiện máy phun rửa áp lực',
                        'sort' => 7,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Kìm nước',
                        'sort' => 8,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Bể, bồn nước lắp ghép',
                        'sort' => 9,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Hộp van nước',
                        'sort' => 9,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Bộ điều chỉnh độ pH',
                        'sort' => 10,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                ),
            ),
            array(
                'label' => 'Thiết bị công cộng',
                'sort' => 9,
                'created_at' => date('Y-m-d H:i:s'),
                'childs' => array(
                    array(
                        'label' => 'Thùng rác công cộng',
                        'sort' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Nhà vệ sinh công cộng',
                        'sort' => 2,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                ),
            ),
            array(
                'label' => 'Vật liệu xây dựng thô',
                'sort' => 10,
                'created_at' => date('Y-m-d H:i:s'),
                'childs' => array(
                    array(
                        'label' => 'Xi măng',
                        'sort' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Sắt',
                        'sort' => 2,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Cát',
                        'sort' => 3,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Đá xây dựng',
                        'sort' => 4,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Đá trang trí',
                        'sort' => 5,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Sỏi',
                        'sort' => 6,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Gạch xây dựng',
                        'sort' => 7,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Vữa',
                        'sort' => 8,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Bê Tông',
                        'sort' => 9,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Phụ gia',
                        'sort' => 10,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                ),
            ),
            array(
                'label' => 'Máy công nghiệp',
                'sort' => 11,
                'created_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'label' => 'Cây và Hoa',
                'sort' => 12,
                'created_at' => date('Y-m-d H:i:s'),
                'childs' => array(
                    array(
                        'label' => 'Cây',
                        'sort' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                    array(
                        'label' => 'Hoa',
                        'sort' => 2,
                        'created_at' => date('Y-m-d H:i:s'),
                    ),
                ),
            ),
            array(
                'label' => 'Vật liệu mới',
                'sort' => 13,
                'created_at' => date('Y-m-d H:i:s'),
            ),
        );

        $langs = \App\Languages::all();
        foreach ($categories as $cate) {

            $row = $this->_setCategory($cate['label'], $cate['sort'], $cate['created_at']);

            $this->_setCategoryTrans($langs, $row->id, $cate['label'], $cate['sort']);

            if (isset($cate['childs'])) {
                foreach ($cate['childs'] as $item) {

                    $parentId = $row->id;

                    $row1 = $this->_setCategory($item['label'], $item['sort'], $item['created_at'], $parentId);

                    $this->_setCategoryTrans($langs, $row1->id, $item['label']);
                }
            }
        }
    }

    private function _setCategory($title, $sort, $createdAt, $parentId = null)
    {
        $type = format_type_product($title);
        $row = Categories::where('type', $type)->first();
        if ($row === NULL) {
            $row = new Categories();
            $row->type = $type;
            $row->sort = $sort;
            $row->created_at = $createdAt;
        } else {
            $row->sort = $sort;
        }
        if ($parentId !== null) {
            $row->parent_id = $parentId;
        }
        $row->save();
        return $row;
    }

    private function _setCategoryTrans($langs, $categoryId, $title)
    {
        $slug = formatSlug($title);
        foreach ($langs as $lang) {
            $rowSub = CategoriesTranslate::where('category_id', $categoryId)->where('language_code', $lang->iso2)->where('slug', $slug)->first();
            if ($rowSub === NULL) {
                $rowSub = new CategoriesTranslate();
                $rowSub->language_code = $lang->iso2;
                $rowSub->category_id = $categoryId;
                $rowSub->title = $title;
                $rowSub->slug = $slug;
                $rowSub->created_at = date('Y-m-d H:i:s');
                $rowSub->save();
            }
        }
    }
}
