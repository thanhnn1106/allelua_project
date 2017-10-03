$(document).ready(function() {

    /*
    $('#login_ajax_button').click(function (event) {
        event.preventDefault();
        $('#loginAjaxform .input-error').html('');
        var url = $('#loginAjaxform').attr('action');

        var data = $('#loginAjaxform').serializeArray();
        data.push({name: 'urlBefore', value: $(this).attr('url-before')});

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'JSON',
            data: data,
            success: function (data) {
                if (data.error === 0) {
                    window.location.href = data.urlRedirect;
                } else {
                    $('.alert').show().find('p').html(data.result);
                }
            },
            error: function (data) {
                Object.keys(data.responseJSON.messages).forEach(function(key) {
                    classElement = '.form-'+key;
                    $('#loginAjaxform '+classElement).find('.input-error').html(data.responseJSON.messages[key][0]);
                });
                $('.alert').show().find('p').html(data.responseJSON.result);
            }
        });
    });
*/
    $('#cart_add_ajax_button').click(function (event) {
        event.preventDefault();
        var form = $('#form-add-cart');

        var data = form.serializeArray();
        $('#butCheckout').hide();

        $('#form-add-cart .form-quantity').find('.input-error').html('').hide();
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            dataType: 'JSON',
            data: data,
            success: function (data) {
                if (data.error == 0) {
                    $('.cartCount').html(data.result);
                    if(data.result > 0) {
                        $('#butCheckout').show();
                    }
                } else {
                    $('.alert').show().find('p').html(data.result);
                }
            },
            error: function (data) {
                Object.keys(data.responseJSON.messages).forEach(function(key) {
                    classElement = '.form-'+key;
                    $('#form-add-cart '+classElement).find('.input-error').html(data.responseJSON.messages[key][0]).show();
                });
                $('.alert').show().find('p').html(data.responseJSON.result);
            }
        });
    });

});

/*
var dialogLogin = $('#dialog-login-form');
openDialogLogin = function () {
        
    dialogLogin.dialog({
        autoOpen: false,
        height: 'auto',
        width: '70%',
        modal: true
    });
};*/

function fncFavorite(event, obj)
{
    event.preventDefault();
    $('.alert-success').hide();

    var data = {
        'product_id': $(obj).attr('data-product-id')
    };

    $.ajax({
        url: $(obj).attr('data-url'),
        type: 'POST',
        dataType: 'JSON',
        data: data,
        success: function (data) {
            if (data.error === 0) {
                // Change button status
                $('.alert-success').find('p').html(data.result);
                $('.alert-success').show();
                $(obj).addClass('active');
            }
        },
        error: function (xhr, textStatus) {
            // Token fail
            if(xhr.status === 400) {
                location.reload();
            } else if (xhr.status === 401) {
                window.location.href = $(obj).attr('data-url-login');
            }
        }
    });
}
