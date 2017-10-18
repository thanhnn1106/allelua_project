<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute phải được chấp nhận.',
    'active_url'           => ':attribute không phải là đường dẫn hợp lệ.',
    'after'                => ':attribute phải sau ngày :date.',
    'after_or_equal'       => ':attribute bằng hoặc sau ngày :date.',
    'alpha'                => ':attribute chỉ chứa chữ cái.',
    'alpha_dash'           => ':attribute chỉ chứa chữ cái, số, dấu gạch ngang.',
    'alpha_num'            => ':attribute chỉ chứa chữ cái và số.',
    'array'                => ':attribute phải là mảng.',
    'before'               => ':attribute phải trước ngày :date.',
    'before_or_equal'      => ':attribute phải bằng hoặc trước ngày :date.',
    'between'              => [
        'numeric' => ':attribute must be between :min and :max.',
        'file'    => ':attribute must be between :min and :max kilobytes.',
        'string'  => ':attribute must be between :min and :max characters.',
        'array'   => ':attribute must have between :min and :max items.',
    ],
    'boolean'              => ':attribute field must be true or false.',
    'confirmed'            => ':attribute xác nhận không khớp.',
    'date'                 => ':attribute không phải ngày hợp lệ.',
    'date_format'          => ':attribute không đúng với định dạng :format.',
    'different'            => ':attribute và :other phải khác nhau.',
    'digits'               => ':attribute Phải là số :digits.',
    'digits_between'       => ':attribute phải là số ở giữa :min và :max.',
    'dimensions'           => ':attribute không đúng định dạng hình ảnh.',
    'distinct'             => ':attribute dữ liệu bị trùng lặp.',
    'email'                => ':attribute phải là địa chỉ mail hợp lệ.',
    'exists'               => ':attribute không hợp lệ.',
    'file'                 => ':attribute phải là tập tin.',
    'filled'               => ':attribute phải có giá trị.',
    'image'                => ':attribute phải là hình ảnh.',
    'in'                   => ':attribute không hợp lệ.',
    'in_array'             => ':attribute không tồn tại trong :other.',
    'integer'              => ':attribute phải là số nguyên.',
    'ip'                   => ':attribute must be a valid IP address.',
    'ipv4'                 => ':attribute must be a valid IPv4 address.',
    'ipv6'                 => ':attribute must be a valid IPv6 address.',
    'json'                 => ':attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => ':attribute may not be greater than :max.',
        'file'    => ':attribute may not be greater than :max kilobytes.',
        'string'  => ':attribute may not be greater than :max characters.',
        'array'   => ':attribute may not have more than :max items.',
    ],
    'mimes'                => ':attribute must be a file of type: :values.',
    'mimetypes'            => ':attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => ':attribute must be at least :min.',
        'file'    => ':attribute must be at least :min kilobytes.',
        'string'  => ':attribute must be at least :min characters.',
        'array'   => ':attribute must have at least :min items.',
    ],
    'not_in'               => ':attribute không hợp lệ.',
    'numeric'              => ':attribute phải là số.',
    'present'              => ':attribute field must be present.',
    'regex'                => ':attribute định dạng không hợp lệ.',
    'required'             => ':attribute phải có giá trị.',
    'required_if'          => ':attribute phải có giá trị khi :other là :value.',
    'required_unless'      => ':attribute field is required unless :other is in :values.',
    'required_with'        => ':attribute field is required when :values is present.',
    'required_with_all'    => ':attribute field is required when :values is present.',
    'required_without'     => ':attribute field is required when :values is not present.',
    'required_without_all' => ':attribute field is required when none of :values are present.',
    'same'                 => ':attribute và :other phải khớp với nhau.',
    'size'                 => [
        'numeric' => ':attribute phải có :size.',
        'file'    => ':attribute phải có :size kilobytes.',
        'string'  => ':attribute phải có :size kí tự.',
        'array'   => ':attribute phải chứa :size phần tử.',
    ],
    'string'               => ':attribute phải là chuỗi.',
    'timezone'             => ':attribute must be a valid zone.',
    'unique'               => ':attribute đã được sử dụng.',
    'uploaded'             => ':attribute tải lên thất bại.',
    'url'                  => ':attribute định dạng không hợp lệ.',
    'unique_with'          => ':attribute đã được sử dụng.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        // Seller personal information
        'tax_code' => [
            'required' => ':attribute không được rỗng.',
            'numeric'  => ':attribute phải là số.',
        ],
        'license_business' => [
            'required' => ':attribute không được rỗng.',
        ],
        'bank_account' => [
            'required' => ':attribute không được rỗng.',
            'numeric'  => ':attribute phải là số.',
        ],
        'bank_name' => [
            'required' => ':attribute không được rỗng.',
        ],
        'bank_address' => [
            'required' => ':attribute không được rỗng.',
        ],
        'introduce_company_en' => [
            'required' => ':attribute không được rỗng.',
        ],
        'introduce_company_vi' => [
            'required' => ':attribute không được rỗng.',
        ],
        // Seller đăng tin
        'categories' => [
            'required' => ':attribute không được rỗng.',
        ],
        'sub_categories' => [
            'required' => ':attribute không được rỗng.',
        ],
        'quantity' => [
            'required' => ':attribute không được rỗng.',
        ],
        'quantity_limit' => [
            'required' => ':attribute không được rỗng.',
        ],
        'price' => [
            'required' => ':attribute không được rỗng.',
        ],
        'payment_method' => [
            'required' => ':attribute không được rỗng.',
        ],
        'shipping_method' => [
            'required' => ':attribute không được rỗng.',
        ],
        'image_thumb' => [
            'required' => ':attribute không được rỗng.',
        ],
        'total_image_detail' => [
            'required' => ':attribute không được rỗng.',
            'min' => ':attribute không được nhỏ hơn 3.',
        ],
        'title_vi' => [
            'required' => ':attribute không được rỗng.',
        ],
        'title_en' => [
            'required' => ':attribute không được rỗng.',
        ],
        'brand_vi' => [
            'required' => ':attribute không được rỗng.',
        ],
        'brand_en' => [
            'required' => ':attribute không được rỗng.',
        ],
        'source_vi' => [
            'required' => ':attribute không được rỗng.',
        ],
        'source_en' => [
            'required' => ':attribute không được rỗng.',
        ],
        'delivery_location_vi' => [
            'required' => ':attribute không được rỗng.',
        ],
        'delivery_location_en' => [
            'required' => ':attribute không được rỗng.',
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        // Seller personal information
        'tax_code' => 'Mã số thuế',
        'license_business' => 'Giấy phép kinh doanh',
        'bank_account' => 'Số tài khoản ngân hàng',
        'bank_name' => 'Tên ngân hàng',
        'bank_address' => 'Địa chỉ ngân hàng',
        'introduce_company_en' => 'Thông tin công ty (tiếng Anh)',
        'introduce_company_vi' => 'Thông tin công ty (tiếng Việt)',
        // Seller đăng tin
        'categories' => 'Danh mục sản phẫm',
        'sub_categories' => 'Danh mục con',
        'quantity' => 'Số lượng',
        'quantity_limit' => 'Số lượng giới hạn',
        'price' => 'Giá',
        'payment_method' => 'Hình thức thanh toán',
        'shipping_method' => 'Hình thức giao hàng',
        'image_thumb' => 'Hình ảnh',
        'total_image_detail' => 'Tổng hình ảnh chi tiết',
        'title_vi' => 'Tiêu đề tiếng Việt',
        'title_en' => 'Tiêu đề tiếng Anh',
        'brand_vi' => 'Thương hiệu (tiếng Việt)',
        'brand_en' => 'Thương hiệu (tiếng Anh)',
        'source_vi' => 'Xuất sứ (tiếng Nhật)',
        'source_en' => 'Xuất sứ (tiếng Anh)',
        'delivery_location_en' => 'Delivery location',
        'delivery_location_vi' => 'Nơi giao hàng',
    ],

];
