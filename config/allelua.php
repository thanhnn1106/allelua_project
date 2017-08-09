<?php
define('LIMIT_ROW', 10);
define('ROLE_ADMIN', 'administrator');
define('ROLE_SELLER', 'seller');
define('DATETIME_FORMAT', 'Y-m-d H:i:s');
return [
    'roles' => array(
        'administrator' => 1,
        'seller'        => 2,
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

    'general_logo' => array(
        'path_upload_logo' => '/uploads/logo',
    ),
    'product_image' => array(
        'path_upload_thumb' => '/uploads/product/thumb',
        'path_upload_detail' => '/uploads/product',
    ),
];