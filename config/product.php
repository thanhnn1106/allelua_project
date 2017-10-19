<?php
return [
    'min_image_detail' => 3,
    'max_image_detail' => 5,
    'file_accept_types' => 'jpeg,png',
    'cate_not_child' => array(
        'may_cong_nghiep', 'vat_lieu_moi'
    ),
    'product_status' => array(
        'label' => array(
            0 => 'product.product_status.draft',
            1 => 'product.product_status.publish',
            2 => 'product.product_status.pending',
        ),
        'value' => array(
            'draft'   => 0,
            'publish' => 1,
            'pending' => 2,
        ),
    ),
    'product_seller_status' => array(
        'label' => array(
            0 => 'product.product_seller_status.draft',
            2 => 'product.product_seller_status.pending',
        ),
        'value' => array(
            'draft'   => 0,
            'pending' => 2,
        ),
    ),
    'payment_method' => array(
        'label' => array(
            1 => 'product.payment_method.type1',
            2 => 'product.payment_method.type2',
            3 => 'product.payment_method.type3',
            4 => 'product.payment_method.type4',
        ),
        'value' => array(
            'value1' => 1,
            'value2' => 2,
            'value3' => 3,
            'value4' => 4,
        ),
    ),
    'shipping_method' => array(
        'label' => array(
            1 => 'product.shipping_method.type1',
            2 => 'product.shipping_method.type2',
            3 => 'product.shipping_method.type3',
        ),
        'value' => array(
            'value1' => 1,
            'value2' => 2,
            'value3' => 3,
        ),
    ),

    'price_1' => array(
        'less_50000' => '50000',
        '50000_100000' => '50000-100000',
        '100000_300000' => '100000_300000',
        '300000_500000' => '300000_500000',
        'great_500000' => '500000',
    ),
    'price_2' => array(
        'less_10000' => '100000',
        '100000_500000' => '100000-500000',
        '500000_2000000' => '500000-2000000',
        '2000000_5000000' => '2000000-5000000',
        'great_5000000' => '5000000',
    ),
    'price_3' => array(
        'less_1000000' => '1000000',
        '1000000_5000000' => '1000000-5000000',
        '5000000_10000000' => '5000000-10000000',
        '10000000_20000000' => '10000000-20000000',
        'great_20000000' => '20000000',
    ),
    'price_4' => array(
        'less_1000000' => '1000000',
        '1000000_5000000' => '1000000-10000000',
        '10000000_100000000' => '10000000-100000000',
        '100000000_500000000' => '100000000-500000000',
        'great_500000000' => '500000000',
    ),

    'gach_men' => array(
        'position_use' => array(
            'living_room' => 'product.gach_men.position_use.living_room',
            'bed_room' => 'product.gach_men.position_use.bed_room',
            'kitchen_room' => 'product.gach_men.position_use.kitchen_room',
            'shower_room' => 'product.gach_men.position_use.shower_room',
            'out_door' => 'product.gach_men.position_use.out_door',
            'orders' => 'product.gach_men.position_use.orders',
        ),
        'size' => array(
            '06_24' => 'product.gach_men.size.06_24',
            '07_30' => 'product.gach_men.size.07_30',
            '07_60' => 'product.gach_men.size.07_60',
            '09_60' => 'product.gach_men.size.09_60',
            '10_30' => 'product.gach_men.size.10_30',
            '12_40' => 'product.gach_men.size.12_40',
            '12_50' => 'product.gach_men.size.12_50',
            '12_60' => 'product.gach_men.size.12_60',
            '15_60' => 'product.gach_men.size.15_60',
            '15_80' => 'product.gach_men.size.15_80',
            '20_25' => 'product.gach_men.size.20_25',
            '25_25' => 'product.gach_men.size.25_25',
            '25_40' => 'product.gach_men.size.25_40',
            '30_30' => 'product.gach_men.size.30_30',
            '30_45' => 'product.gach_men.size.30_45',
            '30_60' => 'product.gach_men.size.30_60',
            '4-5_9-5' => 'product.gach_men.size.4-5_9-5',
            '40_40' => 'product.gach_men.size.40_40',
            '40_80' => 'product.gach_men.size.40_80',
            '40_85' => 'product.gach_men.size.40_85',
            '50_50' => 'product.gach_men.size.50_50',
            '50_86' => 'product.gach_men.size.50_86',
            '60_120' => 'product.gach_men.size.60_120',
            '60_60' => 'product.gach_men.size.60_60',
            '60_80' => 'product.gach_men.size.60_80',
            'orders' => 'product.gach_men.size.orders',
        ),
    ),
    'thiet_bi_ve_sinh' => array(
        'ban_cau_bet_toilet' => array(
            'style' => array(
                'ban_cau_mot_khoi' => 'product.thiet_bi_ve_sinh.ban_cau_bet_toilet.style.ban_cau_mot_khoi',
                'ban_cau_dien_tu' => 'product.thiet_bi_ve_sinh.ban_cau_bet_toilet.style.ban_cau_dien_tu',
                'ban_cau_hai_khoi' => 'product.thiet_bi_ve_sinh.ban_cau_bet_toilet.style.ban_cau_hai_khoi',
                'ban_cau_treo_tuong' => 'product.thiet_bi_ve_sinh.ban_cau_bet_toilet.style.ban_cau_treo_tuong',
                'ket_nuoc_am_tuong' => 'product.thiet_bi_ve_sinh.ban_cau_bet_toilet.style.ket_nuoc_am_tuong',
                'nap_day_nut_nhan_xa' => 'product.thiet_bi_ve_sinh.ban_cau_bet_toilet.style.nap_day_nut_nhan_xa',
            ),
        ),
        'chau_lavabo' => array(
            'style' => array(
                'chau_dat_ban' => 'product.thiet_bi_ve_sinh.chau_lavabo.style.chau_dat_ban',
                'chau_dat_am_ban' => 'product.thiet_bi_ve_sinh.chau_lavabo.style.chau_dat_am_ban',
                'chau_duong_vanh' => 'product.thiet_bi_ve_sinh.chau_lavabo.style.chau_duong_vanh',
                'chau_chan_dai' => 'product.thiet_bi_ve_sinh.chau_lavabo.style.chau_chan_dai',
                'chau_chan_lung' => 'product.thiet_bi_ve_sinh.chau_lavabo.style.chau_chan_lung',
                'chau_treo_tuong' => 'product.thiet_bi_ve_sinh.chau_lavabo.style.chau_treo_tuong',
                'chau_lavabo_kieng' => 'product.thiet_bi_ve_sinh.chau_lavabo.style.chau_lavabo_kieng',
                'bo_gia_do_lavabo' => 'product.thiet_bi_ve_sinh.chau_lavabo.style.bo_gia_do_lavabo',
                'chan_chau_lavabo' => 'product.thiet_bi_ve_sinh.chau_lavabo.style.chan_chau_lavabo',
            ),
        ),
        'voi_chau_voi_bon' => array(
            'style' => array(
                'voi_chau_nong_lanh' => 'product.thiet_bi_ve_sinh.voi_chau_voi_bon.style.voi_chau_nong_lanh',
                'voi_chau_nuoc_lanh' => 'product.thiet_bi_ve_sinh.voi_chau_voi_bon.style.voi_chau_nuoc_lanh',
                'voi_chau_cam_ung' => 'product.thiet_bi_ve_sinh.voi_chau_voi_bon.style.voi_chau_cam_ung',
                'voi_xa_bon_tam' => 'product.thiet_bi_ve_sinh.voi_chau_voi_bon.style.voi_xa_bon_tam',
                'voi_xa_nuoc_lanh' => 'product.thiet_bi_ve_sinh.voi_chau_voi_bon.style.voi_xa_nuoc_lanh',
                'voi_ban_tu_dong' => 'product.thiet_bi_ve_sinh.voi_chau_voi_bon.style.voi_ban_tu_dong',
            ),
        ),
        'sen_tam' => array(
            'style' => array(
                'sen_cay_nong_lanh' => 'product.thiet_bi_ve_sinh.sen_tam.style.sen_cay_nong_lanh',
                'sen_day_nong_lanh' => 'product.thiet_bi_ve_sinh.sen_tam.style.sen_day_nong_lanh',
                'sen_tam_am_tuong' => 'product.thiet_bi_ve_sinh.sen_tam.style.sen_tam_am_tuong',
                'sen_tam_nhiet_do' => 'product.thiet_bi_ve_sinh.sen_tam.style.sen_tam_nhiet_do',
                'bang_sen_sen_thuyen' => 'product.thiet_bi_ve_sinh.sen_tam.style.bang_sen_sen_thuyen',
                'bat_sen_tay_sen_cu_sen' => 'product.thiet_bi_ve_sinh.sen_tam.style.bat_sen_tay_sen_cu_sen',
                'sen_tam_nuoc_lanh' => 'product.thiet_bi_ve_sinh.sen_tam.style.sen_tam_nuoc_lanh',
            ),
        ),
        'bon_tam' => array(
            'style' => array(
                'bon_tam_dat_san' => 'product.thiet_bi_ve_sinh.bon_tam.style.bon_tam_dat_san',
                'bon_tam_xay_am' => 'product.thiet_bi_ve_sinh.bon_tam.style.bon_tam_xay_am',
                'bon_tam_message' => 'product.thiet_bi_ve_sinh.bon_tam.style.bon_tam_message',
            ),
        ),
        'bon_tieu' => array(
            'style' => array(
                'bon_tieu' => 'product.thiet_bi_ve_sinh.bon_tieu.style.bon_tieu',
                'bon_tieu_name' => 'product.thiet_bi_ve_sinh.bon_tieu.style.bon_tieu_name',
                'bon_tieu_nu' => 'product.thiet_bi_ve_sinh.bon_tieu.style.bon_tieu_nu',
                'vach_ngan_tieu' => 'product.thiet_bi_ve_sinh.bon_tieu.style.vach_ngan_tieu',
            ),
        ),
        'van_xa_tieu_xa_toilet' => array(
            'style' => array(
                'van_xa_tieu_nhan_gat' => 'product.thiet_bi_ve_sinh.van_xa_tieu_xa_toilet.style.van_xa_tieu_nhan_gat',
                'van_xa_tieu_cam_ung' => 'product.thiet_bi_ve_sinh.van_xa_tieu_xa_toilet.style.van_xa_tieu_cam_ung',
                'van_xa_gat_toilet' => 'product.thiet_bi_ve_sinh.van_xa_tieu_xa_toilet.style.van_xa_gat_toilet',
            ),
        ),
        'phong_tam' => array(
            'style' => array(
                'khung_tam_dung' => 'product.thiet_bi_ve_sinh.phong_tam.style.khung_tam_dung',
                'phong_dung_message' => 'product.thiet_bi_ve_sinh.phong_tam.style.phong_dung_message',
                'khay_phong_tam' => 'product.thiet_bi_ve_sinh.phong_tam.style.khay_phong_tam',
                'phong_tam_dung_thuong' => 'product.thiet_bi_ve_sinh.phong_tam.style.phong_tam_dung_thuong',
            ),
        ),
        'nap_ban_cau' => array(
            'style' => array(
                'nap_rua_co' => 'product.thiet_bi_ve_sinh.nap_ban_cau.style.nap_rua_co',
                'nap_rua_dien_tu' => 'product.thiet_bi_ve_sinh.nap_ban_cau.style.nap_rua_dien_tu',
                'nap_bong_em' => 'product.thiet_bi_ve_sinh.nap_ban_cau.style.nap_bong_em',
            ),
        ),
        'phu_kien_nha_tam' => array(
            'material' => array(
                'dong_ma_crom' => 'product.thiet_bi_ve_sinh.phu_kien_nha_tam.material.dong_ma_crom',
                'inox' => 'product.thiet_bi_ve_sinh.phu_kien_nha_tam.material.inox',
                'su' => 'product.thiet_bi_ve_sinh.phu_kien_nha_tam.material.su',
                'others' => 'product.thiet_bi_ve_sinh.phu_kien_nha_tam.material.others',
            ),
        ),
    ),
    'thiet_bi_chieu_sang' => array(
        'den_phong_khach' => array(
            'style' => array(
                'den_chum' => 'product.thiet_bi_chieu_sang.den_phong_khach.style.den_chum',
                'den_ap_tran' => 'product.thiet_bi_chieu_sang.den_phong_khach.style.den_ap_tran',
                'den_tha' => 'product.thiet_bi_chieu_sang.den_phong_khach.style.den_tha',
                'den_ap_tuong' => 'product.thiet_bi_chieu_sang.den_phong_khach.style.den_ap_tuong',
                'soi_tranh_guong_soi' => 'product.thiet_bi_chieu_sang.den_phong_khach.style.soi_tranh_guong_soi',
                'den_ban' => 'product.thiet_bi_chieu_sang.den_phong_khach.style.den_ban',
                'den_cay' => 'product.thiet_bi_chieu_sang.den_phong_khach.style.den_cay',
                'quat_den_tran' => 'product.thiet_bi_chieu_sang.den_phong_khach.style.quat_den_tran',
                'orders' => 'product.thiet_bi_chieu_sang.den_phong_khach.style.orders',
            ),
        ),
        'den_phong_tam' => array(
            'style' => array(
                'den_phong_tam_op_tran' => 'product.thiet_bi_chieu_sang.den_phong_tam.style.den_phong_tam_op_tran',
                'den_phong_tam_gan_tuong' => 'product.thiet_bi_chieu_sang.den_phong_tam.style.den_phong_tam_gan_tuong',
                'den_suoi_phong_tam' => 'product.thiet_bi_chieu_sang.den_phong_tam.style.den_suoi_phong_tam',
            ),
        ),
        'den_ban' => array(
            'style' => array(
                'bong_led' => 'product.thiet_bi_chieu_sang.den_ban.style.bong_led',
                'bong_eco' => 'product.thiet_bi_chieu_sang.den_ban.style.bong_eco',
            ),
        ),
        'den_tran_chieu_dem' => array(
            'style' => array(
                'bong_led' => 'product.thiet_bi_chieu_sang.den_tran_chieu_dem.style.bong_led',
                'bong_eco' => 'product.thiet_bi_chieu_sang.den_tran_chieu_dem.style.bong_eco',
            ),
        ),
        'den_ngoai_san_vuong' => array(
            'style' => array(
                'bong_led' => 'product.thiet_bi_chieu_sang.den_ngoai_san_vuong.style.bong_led',
                'bong_eco' => 'product.thiet_bi_chieu_sang.den_ngoai_san_vuong.style.bong_eco',
                'den_tao_kieu_ngoai_troi' => 'product.thiet_bi_chieu_sang.den_ngoai_san_vuong.style.den_tao_kieu_ngoai_troi',
                'dan_cot_san_vuon' => 'product.thiet_bi_chieu_sang.den_ngoai_san_vuong.style.dan_cot_san_vuon',
            ),
        ),
        'bong_chieu_sang_tiet_kiem' => array(
            'style' => array(
                'bong_led' => 'product.thiet_bi_chieu_sang.bong_chieu_sang_tiet_kiem.style.bong_led',
                'bong_eco' => 'product.thiet_bi_chieu_sang.bong_chieu_sang_tiet_kiem.style.bong_eco',
            ),
        ),
        'choa_den' => array(
            'style' => array(
                'bong_led' => 'product.thiet_bi_chieu_sang.choa_den.style.bong_led',
                'bong_eco' => 'product.thiet_bi_chieu_sang.choa_den.style.bong_eco',
            ),
        ),
        'cong_tac' => array(
            'style' => array(
                'cong_tac_the_tu' => 'product.thiet_bi_chieu_sang.cong_tac.style.cong_tac_the_tu',
                'cong_tac_co' => 'product.thiet_bi_chieu_sang.cong_tac.style.cong_tac_co',
                'cong_tac_dien_tu' => 'product.thiet_bi_chieu_sang.cong_tac.style.cong_tac_dien_tu',
            ),
        ),
        'thiet_bi_dong_cat' => array(
            'style' => array(
                'cau_dao_dong_cat' => 'product.thiet_bi_chieu_sang.thiet_bi_dong_cat.style.cau_dao_dong_cat',
                'tu_dien_vo_tu_dien' => 'product.thiet_bi_chieu_sang.thiet_bi_dong_cat.style.tu_dien_vo_tu_dien',
                'thiet_bi_dien_phu_kien' => 'product.thiet_bi_chieu_sang.thiet_bi_dong_cat.style.thiet_bi_dien_phu_kien',
            ),
        ),
        'o_cam' => array(
            'style' => array(
                'o_cam_tv_phone_du_lieu' => 'product.thiet_bi_chieu_sang.o_cam.style.o_cam_tv_phone_du_lieu',
                'o_cam_dien' => 'product.thiet_bi_chieu_sang.o_cam.style.o_cam_dien',
            ),
        ),
    ),

    'noi_that' => array(
        'noi_that_van_phong' => array(
            'style' => array(
                'ban_lam_viec' => 'product.noi_that.noi_that_van_phong.style.ban_lam_viec',
                'ghe_lam_viec' => 'product.noi_that.noi_that_van_phong.style.ghe_lam_viec',
                'ban_viet' => 'product.noi_that.noi_that_van_phong.style.ban_viet',
                'bang_viet' => 'product.noi_that.noi_that_van_phong.style.bang_viet',
                'tu_ho_so' => 'product.noi_that.noi_that_van_phong.style.tu_ho_so',
                'ke_sach_ho_so' => 'product.noi_that.noi_that_van_phong.style.ke_sach_ho_so',
                'ban_tra' => 'product.noi_that.noi_that_van_phong.style.ban_tra',
                'vach_ngan_ban' => 'product.noi_that.noi_that_van_phong.style.vach_ngan_ban',
                'ghe_don' => 'product.noi_that.noi_that_van_phong.style.ghe_don',
            ),
        ),
        'noi_that_phong_khach' => array(
            'style' => array(
                'sofa' => 'product.noi_that.noi_that_phong_khach.style.sofa',
                'ban_sofa' => 'product.noi_that.noi_that_phong_khach.style.ban_sofa',
                'ghe_thu_gian' => 'product.noi_that.noi_that_phong_khach.style.ghe_thu_gian',
                'ke_tv' => 'product.noi_that.noi_that_phong_khach.style.ke_tv',
                'tu_giay' => 'product.noi_that.noi_that_phong_khach.style.tu_giay',
                'tu_trang_tri' => 'product.noi_that.noi_that_phong_khach.style.tu_trang_tri',
            ),
        ),
        'noi_that_phong_ngu' => array(
            'style' => array(
                'giuong' => 'product.noi_that.noi_that_phong_ngu.style.giuong',
                'tu_dau_giuong' => 'product.noi_that.noi_that_phong_ngu.style.tu_dau_giuong',
                'giuong_trang_diem' => 'product.noi_that.noi_that_phong_ngu.style.giuong_trang_diem',
                'tu_quan_ao' => 'product.noi_that.noi_that_phong_ngu.style.tu_quan_ao',
                'ban_trang_diem' => 'product.noi_that.noi_that_phong_ngu.style.ban_trang_diem',
                'chan' => 'product.noi_that.noi_that_phong_ngu.style.chan',
                'ga' => 'product.noi_that.noi_that_phong_ngu.style.ga',
                'goi' => 'product.noi_that.noi_that_phong_ngu.style.goi',
                'nem' => 'product.noi_that.noi_that_phong_ngu.style.nem',
            ),
        ),
        'noi_that_nha_bep' => array(
            'style' => array(
                'tu_bep' => 'product.noi_that.noi_that_nha_bep.style.tu_bep',
                'ban_an' => 'product.noi_that.noi_that_nha_bep.style.ban_an',
                'ghe_an' => 'product.noi_that.noi_that_nha_bep.style.ghe_an',
            ),
        ),
    ),

    'do_gia_dung' => array(
        'dung_cu_lam_do_an' => array(
            'style' => array(
                'dao' => 'product.do_gia_dung.dung_cu_lam_do_an.style.dao',
                'thot' => 'product.do_gia_dung.dung_cu_lam_do_an.style.thot',
                'chen' => 'product.do_gia_dung.dung_cu_lam_do_an.style.chen',
                'dia' => 'product.do_gia_dung.dung_cu_lam_do_an.style.dia',
                'muon' => 'product.do_gia_dung.dung_cu_lam_do_an.style.muon',
                'khan_trai_ban' => 'product.do_gia_dung.dung_cu_lam_do_an.style.khan_trai_ban',
                'orders' => 'product.do_gia_dung.dung_cu_lam_do_an.style.orders',
            ),
        ),
        'may_tam_nuoc_nong' => array(
            'style' => array(
                'may_nuoc_nong_truc_tiep' => 'product.do_gia_dung.may_tam_nuoc_nong.style.may_nuoc_nong_truc_tiep',
                'may_nuoc_nong_gian_tiep' => 'product.do_gia_dung.may_tam_nuoc_nong.style.may_nuoc_nong_gian_tiep',
            ),
        ),
        'may_pha_cafe' => array(
            'style' => array(
                'may_pha_truyen_thong' => 'product.do_gia_dung.may_pha_cafe.style.may_pha_truyen_thong',
                'may_pha_tu_dong' => 'product.do_gia_dung.may_pha_cafe.style.may_pha_tu_dong',
                'espresso' => 'product.do_gia_dung.may_pha_cafe.style.espresso',
                'drip' => 'product.do_gia_dung.may_pha_cafe.style.drip',
                'combi_moka' => 'product.do_gia_dung.may_pha_cafe.style.combi_moka',
                'may_xay_cafe' => 'product.do_gia_dung.may_pha_cafe.style.may_xay_cafe',
                'bot_cafe' => 'product.do_gia_dung.may_pha_cafe.style.bot_cafe',
            ),
        ),
        'ban_ui' => array(
            'style' => array(
                'ban_ui_hoi_nuoc' => 'product.do_gia_dung.ban_ui.style.ban_ui_hoi_nuoc',
                'ban_ui_kem_noi_hoi_nuoc' => 'product.do_gia_dung.ban_ui.style.ban_ui_kem_noi_hoi_nuoc',
                'ban_ui_dung' => 'product.do_gia_dung.ban_ui.style.ban_ui_dung',
                'ban_ui_kho' => 'product.do_gia_dung.ban_ui.style.ban_ui_kho',
            ),
        ),
        'quat' => array(
            'style' => array(
                'quat_phun_suong' => 'product.do_gia_dung.quat.style.quat_phun_suong',
                'quat_sac_da_nang' => 'product.do_gia_dung.quat.style.quat_sac_da_nang',
                'quat_dung' => 'product.do_gia_dung.quat.style.quat_dung',
                'quat_thap' => 'product.do_gia_dung.quat.style.quat_thap',
                'quat_treo' => 'product.do_gia_dung.quat.style.quat_treo',
                'quat_tran' => 'product.do_gia_dung.quat.style.quat_tran',
                'quat_lanh' => 'product.do_gia_dung.quat.style.quat_lanh',
                'quat_lung' => 'product.do_gia_dung.quat.style.quat_lung',
                'quat_hut' => 'product.do_gia_dung.quat.style.quat_hut',
                'quat_hop' => 'product.do_gia_dung.quat.style.quat_hop',
                'quat_can_bang_do_am' => 'product.do_gia_dung.quat.style.quat_can_bang_do_am',
                'quat_khong_canh' => 'product.do_gia_dung.quat.style.quat_khong_canh',
            ),
        ),
    ),

    'thiet_bi_van_phong' => array(
        'may_cham_cong' => array(
            'style' => array(
                'may_cham_cong_tay' => 'product.thiet_bi_van_phong.may_cham_cong.style.may_cham_cong_tay',
                'may_cham_cong_the' => 'product.thiet_bi_van_phong.may_cham_cong.style.may_cham_cong_the',
            )
        ),
        'may_in' => array(
            'style' => array(
                'may_in_da_nang' => 'product.thiet_bi_van_phong.may_in.style.may_in_da_nang',
                'may_in_laser' => 'product.thiet_bi_van_phong.may_in.style.may_in_laser',
                'may_in_kim' => 'product.thiet_bi_van_phong.may_in.style.may_in_kim',
                'may_in_mau' => 'product.thiet_bi_van_phong.may_in.style.may_in_mau',
                'may_in_phun_mau' => 'product.thiet_bi_van_phong.may_in.style.may_in_phun_mau',
            )
        ),
        'may_chieu_projector' => array(
            'style' => array(
                'may_chieu_gia_dinh' => 'product.thiet_bi_van_phong.may_chieu_projector.style.may_chieu_gia_dinh',
                'may_chieu_pho_thong' => 'product.thiet_bi_van_phong.may_chieu_projector.style.may_chieu_pho_thong',
                'may_chieu_hoi_nghi' => 'product.thiet_bi_van_phong.may_chieu_projector.style.may_chieu_hoi_nghi',
                'may_chieu_hd' => 'product.thiet_bi_van_phong.may_chieu_projector.style.may_chieu_hd',
            )
        )
    ),

    'thiet_bi_nganh_nuoc' => array(
        'ong_nuoc' => array(
            'style' => array(
                'ong_nuoc_c0_56' => 'product.thiet_bi_nganh_nuoc.ong_nuoc.style.ong_nuoc_c0_56',
                'ong_nuoc_c1_64' => 'product.thiet_bi_nganh_nuoc.ong_nuoc.style.ong_nuoc_c1_64',
                'ong_nuoc_c2_64' => 'product.thiet_bi_nganh_nuoc.ong_nuoc.style.ong_nuoc_c2_64',
                'ong_nuoc_c3_63' => 'product.thiet_bi_nganh_nuoc.ong_nuoc.style.ong_nuoc_c3_63',
                'ong_nuoc_c4_20' => 'product.thiet_bi_nganh_nuoc.ong_nuoc.style.ong_nuoc_c4_20',
                'ong_nuoc_c5_18' => 'product.thiet_bi_nganh_nuoc.ong_nuoc.style.ong_nuoc_c5_18',
                'ong_nuoc_c6_16' => 'product.thiet_bi_nganh_nuoc.ong_nuoc.style.ong_nuoc_c6_16',
                'ong_nuoc_c7_5' => 'product.thiet_bi_nganh_nuoc.ong_nuoc.style.ong_nuoc_c7_5',
            )
        ),
        'phiu_kien_ong_nuoc' => array(
            'style' => array(
                'ba_chac_70' => 'product.thiet_bi_nganh_nuoc.phiu_kien_ong_nuoc.style.ba_chac_70',
                'bang_tan_14' => 'product.thiet_bi_nganh_nuoc.phiu_kien_ong_nuoc.style.bang_tan_14',
                'bich_noi_32' => 'product.thiet_bi_nganh_nuoc.phiu_kien_ong_nuoc.style.bich_noi_32',
                'cay_dinh_vi_3' => 'product.thiet_bi_nganh_nuoc.phiu_kien_ong_nuoc.style.cay_dinh_vi_3',
                'bich_thep_26' => 'product.thiet_bi_nganh_nuoc.phiu_kien_ong_nuoc.style.bich_thep_26',
                'chech_216' => 'product.thiet_bi_nganh_nuoc.phiu_kien_ong_nuoc.style.chech_216',
                'chu_t_cong_10' => 'product.thiet_bi_nganh_nuoc.phiu_kien_ong_nuoc.style.chu_t_cong_10',
                'chu_t_giam_213' => 'product.thiet_bi_nganh_nuoc.phiu_kien_ong_nuoc.style.chu_t_giam_213',
            )
        ),
        'may_bom' => array(
            'style' => array(
                'may_bom_nuoc_cong_nghiep' => 'product.thiet_bi_nganh_nuoc.may_bom.style.may_bom_nuoc_cong_nghiep',
                'may_bom_thoat_nuoc_thai' => 'product.thiet_bi_nganh_nuoc.may_bom.style.may_bom_thoat_nuoc_thai',
                'may_bom_nuoc_gia_dung' => 'product.thiet_bi_nganh_nuoc.may_bom.style.may_bom_nuoc_gia_dung',
                'may_bom_nuoc_chan_khong' => 'product.thiet_bi_nganh_nuoc.may_bom.style.may_bom_nuoc_chan_khong',
                'bon_nuoc' => 'product.thiet_bi_nganh_nuoc.may_bom.style.bon_nuoc',
            )
        ),
        'he_thong_xu_ly_nuoc' => array(
            'style' => array(
                'thiet_bi_loc_nuoc_xu_ly_nuoc' => 'product.thiet_bi_nganh_nuoc.he_thong_xu_ly_nuoc.style.thiet_bi_loc_nuoc_xu_ly_nuoc',
                'day_chuyen_loc_nuoc' => 'product.thiet_bi_nganh_nuoc.he_thong_xu_ly_nuoc.style.day_chuyen_loc_nuoc',
                'phu_kien_loc_nuoc_cong_nghiep' => 'product.thiet_bi_nganh_nuoc.he_thong_xu_ly_nuoc.style.phu_kien_loc_nuoc_cong_nghiep',
            )
        ),
    ),

    'thiet_bi_nha_bep' => array(
        'may_hut_khoi' => array(
            'style' => array(
                'may_hut_dang_truyen_thong' => 'product.thiet_bi_nha_bep.may_hut_khoi.style.may_hut_dang_truyen_thong',
                'may_hut_dang_treo_doc_lap' => 'product.thiet_bi_nha_bep.may_hut_khoi.style.may_hut_dang_treo_doc_lap',
                'may_hut_dang_cam_ung' => 'product.thiet_bi_nha_bep.may_hut_khoi.style.may_hut_dang_cam_ung',
                'may_hut_cam_bien_nhiet' => 'product.thiet_bi_nha_bep.may_hut_khoi.style.may_hut_cam_bien_nhiet',
                'may_hut_dang_pull_out' => 'product.thiet_bi_nha_bep.may_hut_khoi.style.may_hut_dang_pull_out',
                'may_hut_gan_ap_tuong' => 'product.thiet_bi_nha_bep.may_hut_khoi.style.may_hut_gan_ap_tuong',
                'may_hut_dang_am_tu' => 'product.thiet_bi_nha_bep.may_hut_khoi.style.may_hut_dang_am_tu',
            )
        ),
        'bep_lap_am' => array(
            'style' => array(
                'bep_am_ket_hop' => 'product.thiet_bi_nha_bep.bep_lap_am.style.bep_am_ket_hop',
                'bep_dien_am_hong_ngoai' => 'product.thiet_bi_nha_bep.bep_lap_am.style.bep_dien_am_hong_ngoai',
                'bep_tu_am' => 'product.thiet_bi_nha_bep.bep_lap_am.style.bep_tu_am',
                'bep_gas_am' => 'product.thiet_bi_nha_bep.bep_lap_am.style.bep_gas_am',
                'bep_cong_nghiep' => 'product.thiet_bi_nha_bep.bep_lap_am.style.bep_cong_nghiep',
            )
        ),
        'lo_lap_am' => array(
            'style' => array(
                'lo_nuong_dien_am' => 'product.thiet_bi_nha_bep.lo_lap_am.style.lo_nuong_dien_am',
                'lo_hap_lap_am' => 'product.thiet_bi_nha_bep.lo_lap_am.style.lo_hap_lap_am',
                'lo_vi_song_lap_am' => 'product.thiet_bi_nha_bep.lo_lap_am.style.lo_vi_song_lap_am',
            )
        ),
        'chau_bep_chau_rua_chen' => array(
            'style' => array(
                'chau_don' => 'product.thiet_bi_nha_bep.chau_bep_chau_rua_chen.style.chau_don',
                'chau_1_hoc_1_canh' => 'product.thiet_bi_nha_bep.chau_bep_chau_rua_chen.style.chau_1_hoc_1_canh',
                'chau_2_hoc' => 'product.thiet_bi_nha_bep.chau_bep_chau_rua_chen.style.chau_2_hoc',
                'chau_2_hoc_1_canh' => 'product.thiet_bi_nha_bep.chau_bep_chau_rua_chen.style.chau_2_hoc_1_canh',
                'orders' => 'product.thiet_bi_nha_bep.chau_bep_chau_rua_chen.style.orders',
            ),
            'material' => array(
                'chat_lieu_kim_loai' => 'product.thiet_bi_nha_bep.chau_bep_chau_rua_chen.material.chat_lieu_kim_loai',
                'chat_lieu_da' => 'product.thiet_bi_nha_bep.chau_bep_chau_rua_chen.material.chat_lieu_da',
                'chat_lieu_khac' => 'product.thiet_bi_nha_bep.chau_bep_chau_rua_chen.material.chat_lieu_khac',
            ),
        ),
        'bep_dat_ban' => array(
            'style' => array(
                'bep_dien_tu' => 'product.thiet_bi_nha_bep.bep_dat_ban.style.bep_dien_tu',
                'bep_gas' => 'product.thiet_bi_nha_bep.bep_dat_ban.style.bep_gas',
                'bep_hong_ngoai' => 'product.thiet_bi_nha_bep.bep_dat_ban.style.bep_hong_ngoai',
                'bep_lo_dung' => 'product.thiet_bi_nha_bep.bep_dat_ban.style.bep_lo_dung',
            )
        ),
    ),
    'vat_lieu_xay_dung_tho' => array(
        'ngoi' => array(
            'style' => array(
                'ngoi_song' => 'product.vat_lieu_xay_dung_tho.ngoi.style.ngoi_song',
                'ngoi_phang' => 'product.vat_lieu_xay_dung_tho.ngoi.style.ngoi_phang',
            )
        ),
    ),
];