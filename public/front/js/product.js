var productId = $('#form_product #product_id').val();

$(document).ready(function() {
    // categories change
    if($('#categories').val() !== '') {
        var categoryId = $('#categories').val();
        var url = $('#categories').attr('url-cate');
        loadSubCategory(categoryId, url);
    }
    $('#categories').change(function () {
        var categoryId = $(this).val();
        var url = $(this).attr('url-cate');
        loadSubCategory(categoryId, url);
    });

    $('#sub_categories').change(function () {
        var subCateId = $(this).val();
        var cateId = $('#categories').val();

        loadStyleCategory(cateId, subCateId);
    });
    if($('#hide_sub_category_id').val() !== '') {
        var cateId = $('#hide_category_id').val();
        var subCateId = $('#hide_sub_category_id').val();
        loadStyleCategory(cateId, subCateId);
    }

    $('#image_thumb_preview').click(function () {
        $('#image_thumb').trigger("click");
    });

    // Review image thumb
    $('#image_thumb').change(function (event) {
        event.preventDefault();
        $(this).closest('.form-group').find('.input-error').html('').hide();
        var message = validateImage(this);
        if (message !== '') {
            $(this).closest('.form-group').find('.input-error').html(message).show();
            clearImage(this, event);
            return;
        }
        readURL(this);
    });

    $('.title-slug').bind('keyup change', function () {
        createSlugLink($(this));
    });

    // Save action
    $('#save_product').click(function (event) {
        $('.alert').hide().find('p').html('');
        $('.input-error').html('');

        event.preventDefault();
        var url = $('#form_product').attr('action');
        var data = new FormData(jQuery('form')[1]);
        var total_image_detail = $('#form_product .kv-preview-thumb').find('img').length;
        data.append('total_image_detail', total_image_detail);
        data.append('sortDetail', sortDetail);

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'JSON',
            data: data,
            cache: false,
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            success: function (data) {
                if (data.error === 0) {
                    window.location.href = data.result;
                } else {
                    $('.alert').show().find('p').html(data.result);
                }
            },
            error: function (data) {
                Object.keys(data.responseJSON.messages).forEach(function(key) {
                    classElement = '.form-'+key;
//                    $(classElement).addClass('has-error');
                    $(classElement).find('.input-error').html(data.responseJSON.messages[key][0]);
                });
                $('.alert').show().find('p').html(data.responseJSON.result);
            }
        });
    });

    // Image detail upload
    var imageDetail = $('#image_detail');
    var sortDetail = [];

    imageDetail.fileinput({
        'theme': 'explorer',
        'uploadUrl': product_ajax_upload,
        fileActionSettings: {
            showUpload: false // remove icon upload in each rows
        },
        showUpload: false,
        showRemove: false,
        uploadAsync: false,
        overwriteInitial: false,
        initialPreviewAsData: true,
        browseOnZoneClick: true,
        removeFromPreviewOnError: true,
        initialPreview: initialPreviewImg,
        initialPreviewConfig: initialPreviewConfigImg,
        minFileCount: 3,
        maxFileCount: 5,
        validateInitialCount: true,
        allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif']
    })
    .on('fileclear', function(event) {
        
    })
    .on("filepredelete", function(event, key, jqXHR, data) {
        var abort = true;
        if (confirm('Are you sure delete image ?')) {
            abort = false;
        }
        return abort; // you can also send any data/object that you can receive on `filecustomerror` event
    })
    .on('filesorted', function(event, params) {
        // Reset positon of image when sort
        var stacks = params.stack;
        for(index in stacks) {
            sortDetail[index] = stacks[index].extra.rand_name;
        }
    });

});

function createSlugLink(obj) {
    var lang = $(obj).attr('lang');
    var str = $(obj).val();
    var slug = formatSlug(str);
    $(obj).closest('.box-body').find('.slug-'+lang).html(slug);
}

function fncDelImg(obj, event)
{
    event.preventDefault();
    clearImage(obj);
}

function clearImage(obj)
{
    $(obj).closest('.form-upload').find('.img-value').val('');
    $(obj).closest('.form-upload').find('.control-but').html('');
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(event) {
            if (event.target.result != 'data:') {
                var html = '<img />';
                var strImg = $($.parseHTML(html)).attr('src', event.target.result);
                $('#content_img').find('.img-review').html(strImg);
                var content = $('#content_img').html();
                $(input).closest('.form-upload').find('.btn-upload').html(content);
            }
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function validateImage(obj)
{
    var maxSize = 1048756; // 2 MB
    var size = obj.files[0].size;
    if (size === undefined || size <= 0 || size > maxSize) {
        return 'Have a problem with file '+obj.files[0].name;
    }

    var fileExtension = ['jpeg', 'jpg', 'png', 'gif'];
    if ($.inArray($(obj).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        return "Only formats are allowed : "+fileExtension.join(', ');
    }

    return '';
}

function loadSubCategory(categoryId, url)
{
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'JSON',
        data: {
            categoryId: categoryId,
            subCategory: $('#hide_sub_category_id').val()
        },
        cache: false,
        success: function (data) {
            if (data.error === 0) {
                $('#sub_categories').html(data.result);
                $('#load_style').html('');
            }
        }
    });
}

function loadStyleCategory(cateId, subCateId)
{
    var url = $('#sub_categories').attr('data-url');
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'JSON',
        data: {
            categoryId: cateId,
            subCategory: subCateId,
            positionUse: $('#hide_position_use').val(),
            size: $('#hide_size').val(),
            style: $('#hide_style').val(),
            material: $('#hide_material').val()
        },
        cache: false,
        success: function (data) {
            if (data.error === 0) {
                $('#load_style').html(data.result);
            }
        }
    });
}