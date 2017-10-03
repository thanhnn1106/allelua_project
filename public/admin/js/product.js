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

    // Review image thumb
    $('#image_thumb').change(function (event) {
        event.preventDefault();
        $(this).closest('.form-upload').find('.help-block').html('').hide();
        var message = validateImage(this);
        if (message !== '') {
            $(this).closest('.form-image_thumb').addClass('has-error');
            $(this).closest('.form-upload').find('.help-block').html(message).show();
            clearImage(this, event);
            return;
        }
        readURL(this);
    });

    $("#seller").keyup(function(e){
        if($(this).val() === '') {
            $('#seller_id').val('');
            return false;
        }
    });

    // Autocomplete postal code
    var urlSeller = $( "#seller" ).attr('data-url');
    $( "#seller" ).autocomplete({
        source: function (request, response) {
            $.ajax({
                data: {
                    term: request.term
                },
                global: false,
                type: 'GET',
                url: urlSeller,
                success: function (data) {
                    if(data.length) {
                        response(data);
                    } else {
                        $('#seller_id').val('');
                    }
                }
            });
        },
        minLength: 5,
        select: function( event, ui ) {
            $('#seller').val(ui.item.value);
            $('#seller_id').val(ui.item.id);
        }
    });

    $('.title-slug').bind('keyup change', function () {
        createSlugLink($(this));
    });

    // Save action
    var fileDetail = {};

    $('#save_product').click(function (event) {
        $('.alert').hide().find('p').html('');
        $('.help-block').html('');
        $('#form_product').find('.has-error').removeClass('has-error');

        event.preventDefault();
        var url = $('#form_product').attr('action');

        var formData = new FormData();
        var model_data = $("#form_product").serializeArray();
        $.each(model_data,function(key, input){
            formData.append(input.name, input.value);
        });
        if($('#image_thumb')[0].files[0] !== undefined) {
            formData.append('image_thumb', $('#image_thumb')[0].files[0]);
        }

        var total_image_detail = $('#form_product .kv-preview-thumb').find('img').length;
        formData.append('total_image_detail', total_image_detail);
        formData.append('sortDetail', sortDetail);
        for(var i in fileDetail) {
            formData.append('files[]', fileDetail[i]);
        }

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'JSON',
            data: formData,
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
                    $(classElement).addClass('has-error');
                    $(classElement).find('.help-block').html(data.responseJSON.messages[key][0]);
                });
                $('.alert').show().find('p').html(data.responseJSON.result);
            }
        });
    });

    // Image detail upload
    var imageDetail = $('#image_detail');
    var sortDetail = [];

    imageDetail.fileinput({
        theme: 'explorer',
        uploadUrl: product_ajax_upload,
        fileActionSettings: {
            showUpload: false // remove icon upload in each rows
        },
        showUpload: false,
        showRemove: false,
        uploadAsync: false,
        overwriteInitial: false,
        initialPreviewAsData: true,
        browseOnZoneClick: true,
//        removeFromPreviewOnError: true,
        initialPreview: initialPreviewImg,
        initialPreviewConfig: initialPreviewConfigImg,
        //minFileCount: 3,
        maxFileCount: 5,
        resizeImage: true,
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
    }).on("fileloaded", function(event, file, previewId, index, reader) {
        fileDetail[previewId] = file;
    }).on("fileremoved", function(event, id, index) {
        if(fileDetail[id] !== undefined) {
            delete fileDetail[id];
        }
    });

});
$(document).on('filebatchselected', '.btn-file :file', function(event, files) {
    
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
                $(input).closest('.form-upload').find('.control-but').html(content);
            }
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function validateImage(obj)
{
    var maxSize = 4048756; // 2 MB
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
