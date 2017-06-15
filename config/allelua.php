<?php
define('LIMIT_ROW', 10);
define('ROLE_ADMIN', 'administrator');
define('ROLE_SELLER', 'seller');
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
];