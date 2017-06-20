$(document).ready(function() {
    // categories change
    $('#categories').change(function () {
        var categoryId = $(this).val();
        var url = $(this).attr('url-cate');
        loadSubCategory(categoryId, url);
    });

    $('#sub_categories').change(function () {
        loadStyleCategory(this);
    });

    // Review image thumb
    $('#image_thumb').change(function (event) {
        event.preventDefault();
        $(this).closest('.form-group').find('.error-msg').html(message).hide();
        var message = validateImage(this);
        if (message !== '') {
            clearImage(this, event);
            $(this).closest('.form-group').find('.error-msg').html(message).show();
            return;
        }
        readURL(this, 'image_thumb_review');
    });

    $('#image_detail').change(function (event) {
        event.preventDefault();
        $(this).closest('.form-group').find('.error-msg').html(message).hide();
        var message = validateImage(this);
        if (message !== '') {
            clearImage(this, event);
            $(this).closest('.form-group').find('.error-msg').html(message).show();
            return;
        }
        readURL(this, 'image_detail_review', true);
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
                    response(data);
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
    $(obj).closest('.form-group').find('.img-value').val('');
    $(obj).closest('li').remove();
}

function readURL(input, divId, isMulti) {
    if (input.files) {
        var filesAmount = input.files.length;
        for (i = 0; i < filesAmount; i++) {
            if (input.files && input.files[i]) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    if (event.target.result != 'data:') {
                        var html = '<li><img width="100px" height="100px" /><br/><a href="javascript:void(0)" onclick="fncDelImg(this, event);" class="delete-img" style="vertical-align: bottom">Delete</a></li>';
                        if(isMulti) {
                            $($.parseHTML(html)).find('img').attr('src', event.target.result).closest('li').appendTo($('#'+divId));
                        } else {
                            $('#'+divId).html('');
                            $($.parseHTML(html)).find('img').attr('src', event.target.result).closest('li').appendTo($('#'+divId));
                        }
                        $('#'+divId).show();
                    }
                }

                reader.readAsDataURL(input.files[i]);
            }
        }
    }
}

function validateImage(obj)
{
    var filesAmount = obj.files.length;
    for (i = 0; i < filesAmount; i++) {
        var maxSize = 1048756; // 2 MB
        var size = obj.files[i].size;
        if (size === undefined || size <= 0 || size > maxSize) {
            return 'Have a problem with file '+obj.files[i].name+'. Please try again';
        }

        var fileExtension = ['jpeg', 'jpg', 'png', 'gif'];
        if ($.inArray($(obj).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            return "Only formats are allowed : "+fileExtension.join(', ');
        }
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
            categoryId: categoryId
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

function loadStyleCategory(obj)
{
    var url = $(obj).attr('data-url');
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'JSON',
        data: {
            categoryId: $('#categories').val(),
            subCategory: $(obj).val()
        },
        cache: false,
        success: function (data) {
            if (data.error === 0) {
                $('#load_style').html(data.result);
            }
        }
    });
}
