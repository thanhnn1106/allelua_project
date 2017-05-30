function putFooterBottom() {
    if ($(document).height() > $(window).height()) {
        $("body").css("position", "relative");
    }
}

function disableInputField(parentSelector) {
    if ($('body').hasClass('not-edit')) {
        $(parentSelector+ " input").attr('disabled', 'disabled');
        $(parentSelector+ " textarea").attr('disabled', 'disabled');
        $(parentSelector).parent().find("button:not(.ui-dialog-titlebar-close)").attr('disabled', 'disabled');
    }
}


$('.show-loading').on('click', function() {
    $('#wrapper-loading').css('display', 'block');
})