<?php
define('LIMIT_ROW', 10);
define('ROLE_ADMIN', 'administrator');
define('ROLE_SELLER', 'seller');
define('DATETIME_FORMAT', 'Y-m-d H:i:s');
define('ROLE_USER', 'user');
return [
    'roles' => array(
        'administrator' => 1,
        'seller'        => 2,
        'user'        => 3,
    ),
    'user_status' => array(
        'label' => array(
            1 => 'Active',
            0 => 'Inactive',
        ),
        'value' => array(
            'active'   => 1,
            'inactive' => 0
        ),
    ),
    'sex' => array(
        'label' => array(
            1 => 'front.register_page.sex.male',
            0 => 'front.register_page.sex.female',
        ),
        'value' => array(
            'male' => 1,
            'female' => 0
        ),
    ),

    'general_logo' => array(
        'path_upload_logo' => '/uploads/logo',
    ),
    'product_image' => array(
        'path_upload_thumb' => '/uploads/product/thumb',
        'path_upload_detail' => '/uploads/product',
    ),
];