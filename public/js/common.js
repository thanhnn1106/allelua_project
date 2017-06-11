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

function formatSlug(str) 
{
    str = str.toLowerCase();
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    str = str.replace(/đ/g, "d");
    //str= str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g,"-");  
    /* tìm và thay thế các kí tự đặc biệt trong chuỗi sang kí tự - */
    //str= str.replace(/-+-/g,"-"); //thay thế 2- thành 1-  
    //str = str.replace(/^\-+|\-+$/g, "");
    str = str.replace(/\s+/g, '-');
    str = str.replace(/\'/g, '');
    str = str.replace(/\"/g, '');
    str = str.replace(/\(/g, '');
    str = str.replace(/\)/g, '');
    return str;
}

$('.show-loading').on('click', function() {
    $('#wrapper-loading').css('display', 'block');
})