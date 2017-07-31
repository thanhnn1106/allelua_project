<?php

return [
    'product_status' => array(
        'draft'   => 'Draft',
        'publish' => 'Publish',
    ),
    'product_seller_status' => array(
        'draft'   => 'Nháp',
        'pending' => 'chờ approve',
    ),
    'payment_method' => array(
        'type1' => 'Thanh toán khi nhận hàng',
        'type2' => 'Thẻ tín dụng/ghi nợ',
        'type3' => 'Thẻ ATM nội địa',
        'type4' => 'Trả góp bằng thẻ tín dụng',
    ),
    'shipping_method' => array(
        'type1' => 'Giao hàng tiết kiệm',
        'type2' => 'Giao hàng tiêu chuẩn',
        'type3' => 'Giao hàng hỏa tốc',
    ),

    'gach_men' => array(
        'position_use' => array(
            'living_room' => 'Phòng khách',
            'bed_room' => 'Phòng ngủ',
            'kitchen_room' => 'Phòng nhà bếp',
            'shower_room' => 'Phòng tắm',
            'out_door' => 'Ngoài trời',
            'orders' => 'Khác',
        ),
        'size' => array(
            '06_24' => '06x24',
            '07_30' => '07x30',
            '07_60' => '07x60',
            '09_60' => '09x60',
            '10_30' => '10x30',
            '12_40' => '12x40',
            '12_50' => '12x50',
            '12_60' => '12x60',
            '15_60' => '15x60',
            '15_80' => '15x80',
            '20_25' => '20x25',
            '25_25' => '25x25',
            '25_40' => '25x40',
            '30_30' => '30x30',
            '30_45' => '30x45',
            '30_60' => '30x60',
            '4-5_9-5' => '4.5x9.5',
            '40_40' => '40x40',
            '40_80' => '40x80',
            '40_85' => '40x85',
            '50_50' => '50x50',
            '50_86' => '50x86',
            '60_120' => '60x120',
            '60_60' => '60x60',
            '60_80' => '60x80',
            'orders' => 'Orders',
        )
    ),
    'thiet_bi_ve_sinh' => array(
        'ban_cau_bet_toilet' => array(
            'style' => array(
                'ban_cau_mot_khoi' => 'Bàn Cầu Một Khối',
                'ban_cau_dien_tu' => 'Bàn Cầu Điện Tử',
                'ban_cau_hai_khoi' => 'Bàn Cầu Hai Khối',
                'ban_cau_treo_tuong' => 'Bàn Cầu Treo Tường',
                'ket_nuoc_am_tuong' => 'Két Nước Ấm Tường',
                'nap_day_nut_nhan_xa' => 'Nắp Đậy Nút Nhấn Xả',
            ),
        ),
        'chau_lavabo' => array(
            'style' => array(
                'chau_dat_ban' => 'Chậu Đặt Bàn',
                'chau_dat_am_ban' => 'Chậu Đặt Âm Bàn',
                'chau_duong_vanh' => 'Chậu Dương Vành',
                'chau_chan_dai' => 'Chậu Chân Dài',
                'chau_chan_lung' => 'Chậu Chân Lửng',
                'chau_treo_tuong' => 'Chậu Treo Tường',
                'chau_lavabo_kieng' => 'Chậu Lavabo Kiếng',
                'bo_gia_do_lavabo' => 'Bộ Giá Đở Lavabo',
                'chan_chau_lavabo' => 'Chân Chậu Lavabo',
            ),
        ),
        'voi_chau_voi_bon' => array(
            'style' => array(
                'voi_chau_nong_lanh' => 'Vòi Chậu Nóng Lạnh',
                'voi_chau_nuoc_lanh' => 'Vòi Chậu Nước Lạnh',
                'voi_chau_cam_ung' => 'Vòi Chậu Cảm Ứng',
                'voi_xa_bon_tam' => 'Vòi Xả Bồn Tắm',
                'voi_xa_nuoc_lanh' => 'Vòi Xả Nước Lạnh',
                'voi_ban_tu_dong' => 'Vòi Bán Tự Động',
            ),
        ),
        'sen_tam' => array(
            'style' => array(
                'sen_cay_nong_lanh' => 'Sen Cây Nóng Lạnh',
                'sen_day_nong_lanh' => 'Sen Dây Nóng Lạnh',
                'sen_tam_am_tuong' => 'Sen Tắm Âm Tường',
                'sen_tam_nhiet_do' => 'Sen Tắm Nhiệt Độ',
                'bang_sen_sen_thuyen' => 'Bảng Sen - Sen Thuyền',
                'bat_sen_tay_sen_cu_sen' => 'Bát Sen - Tay Sen - Củ Sen',
                'sen_tam_nuoc_lanh' => 'Sen Tắm Nước Lạnh',
            ),
        ),
        'bon_tam' => array(
            'style' => array(
                'bon_tam_dat_san' => 'Bồn Tắm Đặt Sàn',
                'bon_tam_xay_am' => 'Bồn Tắm Xây Âm',
                'bon_tam_message' => 'Bồn Tắm Massage',
            ),
        ),
        'bon_tieu' => array(
            'style' => array(
                'bon_tieu' => 'Bồn Tiểu',
                'bon_tieu_name' => 'Bồn Tiểu Nam',
                'bon_tieu_nu' => 'Bồn Tiểu Nữ',
                'vach_ngan_tieu' => 'Vách Ngăn Tiểu',
            ),
        ),
        'van_xa_tieu_xa_toilet' => array(
            'style' => array(
                'van_xa_tieu_nhan_gat' => 'Van Xả Tiểu Nhấn - Gạt',
                'van_xa_tieu_cam_ung' => 'Van Xả Tiểu Cảm Ứng',
                'van_xa_gat_toilet' => 'Van Xả Gạt Toilet',
            ),
        ),
        'phong_tam' => array(
            'style' => array(
                'khung_tam_dung' => 'Khung Tắm Đứng',
                'phong_dung_message' => 'Phòng Đứng Massage',
                'khay_phong_tam' => 'Khay Phòng Tắm',
                'phong_tam_dung_thuong' => 'Phòng Tắm Đứng Thường',
            ),
        ),
        'nap_ban_cau' => array(
            'style' => array(
                'nap_rua_co' => 'Nắp Rửa Cơ',
                'nap_rua_dien_tu' => 'Nắp Rửa Điện Tử',
                'nap_bong_em' => 'Nắp Đóng Êm',
            ),
        ),
        'phu_kien_nha_tam' => array(
            'material' => array(
                'dong_ma_crom' => 'Đồng mạ Crom',
                'inox' => 'Inox',
                'su' => 'Sứ',
                'others' => 'Khác',
            ),
        ),
    ),
    'thiet_bi_chieu_sang' => array(
        'den_phong_khach' => array(
            'style' => array(
                'den_chum' => 'Đèn chùm',
                'den_ap_tran' => 'Đèn áp trần',
                'den_tha' => 'Đèn Thả',
                'den_ap_tuong' => 'Đền áp tường',
                'soi_tranh_guong_soi' => 'Đèn soi tranh, gương soi',
                'den_ban' => 'Đèn bàn',
                'den_cay' => 'Đèn cây',
                'quat_den_tran' => 'Quạt trần đèn',
                'orders' => 'Khác',
            ),
        ),
        'den_phong_tam' => array(
            'style' => array(
                'den_phong_tam_op_tran' => 'Đèn Phòng Tắm Ốp Trần',
                'den_phong_tam_gan_tuong' => 'Đèn Phòng Tắm Gắn Tường',
                'den_suoi_phong_tam' => 'Đèn Sưởi Phòng Tắm',
            ),
        ),
        'den_ban' => array(
            'style' => array(
                'bong_led' => 'Đèn Bàn (Bóng LED)',
                'bong_eco' => 'Đèn Bàn (Bóng ECO)',
            ),
        ),
        'den_tran_chieu_dem' => array(
            'style' => array(
                'bong_led' => 'Đèn Bàn (Bóng LED)',
                'bong_eco' => 'Đèn Bàn (Bóng ECO)',
            ),
        ),
        'den_ngoai_san_vuong' => array(
            'style' => array(
                'bong_led' => 'Đèn Bóng LED',
                'bong_eco' => 'Đèn Bóng ECO',
                'den_tao_kieu_ngoai_troi' => 'Đèn Tạo Kiểu Ngoài Trời',
                'dan_cot_san_vuon' => 'Đèn Cột Sân Vườn',
            ),
        ),
        'bong_chieu_sang_tiet_kiem' => array(
            'style' => array(
                'bong_led' => 'Đèn Bóng LED',
                'bong_eco' => 'Đèn Bóng ECO',
            ),
        ),
        'choa_den' => array(
            'style' => array(
                'bong_led' => 'Đèn Bóng LED',
                'bong_eco' => 'Đèn Bóng ECO',
            ),
        ),
        'cong_tac' => array(
            'style' => array(
                'cong_tac_the_tu' => 'Công Tắc Thẻ Từ',
                'cong_tac_co' => 'Công Tắc Cơ',
                'cong_tac_dien_tu' => 'Công Tắc Điện Tử',
            ),
        ),
        'thiet_bi_dong_cat' => array(
            'style' => array(
                'cau_dao_dong_cat' => 'Cầu Dao Đóng Cắt',
                'tu_dien_vo_tu_dien' => 'Tủ Điện & Vỏ Tủ Điện',
                'thiet_bi_dien_phu_kien' => 'Thiết Bị Điện & Phụ Kiện',
            ),
        ),
        'o_cam' => array(
            'style' => array(
                'o_cam_tv_phone_du_lieu' => 'Ổ Cấm TV, Phone, Dữ Liệu',
                'o_cam_dien' => 'Ổ Cấm Điện',
            ),
        ),
    ),

    'noi_that' => array(
        'noi_that_van_phong' => array(
            'style' => array(
                'ban_lam_viec' => 'Bàn Làm Việc',
                'ghe_lam_viec' => 'Ghế Làm Việc',
                'ban_viet' => 'Bàn họp',
                'bang_viet' => 'Bảng viết',
                'tu_ho_so' => 'Tủ Hồ Sơ',
                'ke_sach_ho_so' => 'Kệ Sách - Hồ Sơ',
                'ban_tra' => 'Bàn Trà',
                'vach_ngan_ban' => 'Vách ngăn bàn',
                'ghe_don' => 'Ghế đơn',
            ),
        ),
        'noi_that_phong_khach' => array(
            'style' => array(
                'sofa' => 'Sofa',
                'ban_sofa' => 'Bàn Sofa',
                'ghe_thu_gian' => 'Ghế Thư Giản',
                'ke_tv' => 'Kệ Tivi',
                'tu_giay' => 'Tủ Giày',
                'tu_trang_tri' => 'Tủ Trang Trí',
            ),
        ),
        'noi_that_phong_ngu' => array(
            'style' => array(
                'giuong' => 'Giường',
                'tu_dau_giuong' => 'Tủ Đầu Giường',
                'giuong_trang_diem' => 'Gương Trang Điểm',
                'tu_quan_ao' => 'Tủ Quần Áo',
                'ban_trang_diem' => 'Bàn Trang Điểm',
                'chan' => 'Chăn',
                'ga' => 'Ga',
                'goi' => 'Gối',
                'nem' => 'Nệm',
            ),
        ),
        'noi_that_nha_bep' => array(
            'style' => array(
                'tu_bep' => 'Tủ bếp',
                'ban_an' => 'Bàn ăn',
                'ghe_an' => 'Ghế ăn',
            ),
        ),
    ),

    'do_gia_dung' => array(
        'dung_cu_lam_do_an' => array(
            'style' => array(
                'dao' => 'Dao',
                'thot' => 'Thớt',
                'chen' => 'Chén',
                'dia' => 'Đĩa',
                'muon' => 'Muỗn',
                'khan_trai_ban' => 'Khăn trải bàn',
                'orders' => 'Khác',
            ),
        ),
        'may_tam_nuoc_nong' => array(
            'style' => array(
                'may_nuoc_nong_truc_tiep' => 'Máy Nước Nóng Trực Tiếp',
                'may_nuoc_nong_gian_tiep' => 'Máy Nước Nóng Gián Tiếp',
            ),
        ),
        'may_pha_cafe' => array(
            'style' => array(
                'may_pha_truyen_thong' => 'Máy Pha Truyền Thống',
                'may_pha_tu_dong' => 'Máy Pha Cà Phê Tự Động',
                'espresso' => 'Espresso',
                'drip' => 'Drip',
                'combi_moka' => 'Combi Moka',
                'may_xay_cafe' => 'Máy Xay Cà Phê',
                'bot_cafe' => 'Bột Cà Phê',
            ),
        ),
        'ban_ui' => array(
            'style' => array(
                'ban_ui_hoi_nuoc' => 'Bàn Ủi Hơi Nước',
                'ban_ui_kem_noi_hoi_nuoc' => 'Bàn Ủi Kèm Nồi Hơi Nước',
                'ban_ui_dung' => 'Bàn Ủi Đứng',
                'ban_ui_kho' => 'Bàn Ủi Khô ',
            ),
        ),
        'quat' => array(
            'style' => array(
                'quat_phun_suong' => 'Quạt Phun Sương',
                'quat_sac_da_nang' => 'Quạt Sạc Đa Năng',
                'quat_dung' => 'Quạt Đứng',
                'quat_thap' => 'Quạt Tháp',
                'quat_treo' => 'Quạt Treo',
                'quat_tran' => 'Quạt Trần',
                'quat_lanh' => 'Quạt Lạnh',
                'quat_lung' => 'Quạt Lửng',
                'quat_hut' => 'Quạt Hút',
                'quat_hop' => 'Quạt Hộp',
                'quat_can_bang_do_am' => 'Quạt Cân Bằng Độ Ẩm',
                'quat_khong_canh' => 'Quạt Không Cánh',
            ),
        ),
    ),

    'thiet_bi_van_phong' => array(
        'may_cham_cong' => array(
            'style' => array(
                'may_cham_cong_tay' => 'Máy Chấm Công Tay',
                'may_cham_cong_the' => 'Máy Chấm Công Thẻ',
            )
        ),
        'may_in' => array(
            'style' => array(
                'may_in_da_nang' => 'Máy In Đa Năng',
                'may_in_laser' => 'Máy In Laser',
                'may_in_kim' => 'Máy In Kim',
                'may_in_mau' => 'Máy In Màu',
                'may_in_phun_mau' => 'Máy In Phun Màu',
            )
        ),
        'may_chieu_projector' => array(
            'style' => array(
                'may_chieu_gia_dinh' => 'Máy Chiếu Gia Đình',
                'may_chieu_pho_thong' => 'Máy Chiếu Phổ Thông',
                'may_chieu_hoi_nghi' => 'Máy Chiếu Hội Nghị',
                'may_chieu_hd' => 'Máy Chiếu HD',
            )
        ),
    ),

    'thiet_bi_nganh_nuoc' => array(
        'ong_nuoc' => array(
            'style' => array(
                'ong_nuoc_c0_56' => 'Ống C0 (56)',
                'ong_nuoc_c1_64' => 'Ống C1 (64)',
                'ong_nuoc_c2_64' => 'Ống C2 (64)',
                'ong_nuoc_c3_63' => 'Ống C3 (63)',
                'ong_nuoc_c4_20' => 'Ống C4 (20)',
                'ong_nuoc_c5_18' => 'Ống C5 (18)',
                'ong_nuoc_c6_16' => 'Ống C6 (16)',
                'ong_nuoc_c7_5' => 'Ống C7 (5)',
            )
        ),
        'phiu_kien_ong_nuoc' => array(
            'style' => array(
                'ba_chac_70' => 'Ba chạc (70)',
                'bang_tan_14' => 'Băng tan (14)',
                'bich_noi_32' => 'Bích nối (32)',
                'cay_dinh_vi_3' => 'Cây định vị (3)',
                'bich_thep_26' => 'Bích thép (26)',
                'chech_216' => 'Chếch (216)',
                'chu_t_cong_10' => 'Chữ T cong (10)',
                'chu_t_giam_213' => 'Chữ T giảm (213)',
            )
        ),
        'may_bom' => array(
            'style' => array(
                'may_bom_nuoc_cong_nghiep' => 'Máy bơm nước công nghiệp',
                'may_bom_thoat_nuoc_thai' => 'Máy bơm thoát nước thải',
                'may_bom_nuoc_gia_dung' => 'Máy bơm nước gia dụng',
                'may_bom_nuoc_chan_khong' => 'Máy bơm nước chân không',
                'bon_nuoc' => 'Bồn nước',
            )
        ),
        'he_thong_xu_ly_nuoc' => array(
            'style' => array(
                'thiet_bi_loc_nuoc_xu_ly_nuoc' => 'Thiết bị lọc nước, xử lý nước',
                'day_chuyen_loc_nuoc' => 'Dây chuyền lọc nước',
                'phu_kien_loc_nuoc_cong_nghiep' => 'Phụ kiện lọc nước công nghiệp',
            )
        ),
    ),

    'thiet_bi_nha_bep' => array(
        'may_hut_khoi' => array(
            'style' => array(
                'may_hut_dang_truyen_thong' => 'Máy Hút Dạng Truyền Thống',
                'may_hut_dang_treo_doc_lap' => 'Máy Hút Dạng Treo Độc Lập',
                'may_hut_dang_cam_ung' => 'Máy Hút Dạng Cảm Ứng',
                'may_hut_cam_bien_nhiet' => 'Máy Hút Cảm Biến Nhiệt',
                'may_hut_dang_pull_out' => 'Máy Hút Dạng Pull-Out',
                'may_hut_gan_ap_tuong' => 'Máy Hút Gắn Áp Tường',
                'may_hut_dang_am_tu' => 'Máy Hút Dạng Âm Tủ',
            )
        ),
        'bep_lap_am' => array(
            'style' => array(
                'bep_am_ket_hop' => 'Bếp Âm Kết Hợp',
                'bep_dien_am_hong_ngoai' => 'Bếp Điện Âm (Hồng Ngoại)',
                'bep_tu_am' => 'Bếp Từ Âm',
                'bep_gas_am' => 'Bếp Gas Âm',
                'bep_cong_nghiep' => 'Bếp công nghiệp',
            )
        ),
        'lo_lap_am' => array(
            'style' => array(
                'lo_nuong_dien_am' => 'Lò Nướng Điện Âm',
                'lo_hap_lap_am' => 'Lò Hấp Lấp Âm',
                'lo_vi_song_lap_am' => 'Lò Vi Sóng Lấp Âm',
            )
        ),
        'chau_bep_chau_rua_chen' => array(
            'style' => array(
                'chau_don' => 'Chậu đơn',
                'chau_1_hoc_1_canh' => 'Chậu 1 hộc 1 cánh',
                'chau_2_hoc' => 'Chậu hai hộc',
                'chau_2_hoc_1_canh' => 'Chậu 2 hộc 1 cánh',
                'orders' => 'Chậu 2 hộc 1 cánh',
            ),
            'material' => array(
                'chat_lieu_kim_loai' => 'Chất liệu kim loại',
                'chat_lieu_da' => 'Chất liệu đá',
                'chat_lieu_khac' => 'Chất liệu khác',
            ),
        ),
        'bep_dat_ban' => array(
            'style' => array(
                'bep_dien_tu' => 'Bếp Điện Từ',
                'bep_gas' => 'Bếp Gas',
                'bep_hong_ngoai' => 'Bếp Hồng Ngoại',
                'bep_lo_dung' => 'Bếp Lò Đứng',
            )
        ),
    ),
];

