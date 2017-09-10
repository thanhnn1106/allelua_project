$(document).ready(function () {
    $('#birthday_day').change(function () {
        validBirthDay();
    });
    $('#birthday_month').change(function () {
        validBirthDay();
    });
    $('#birthday_year').change(function () {
        validBirthDay();
    });
    function validBirthDay()
    {
        var day = $('#birthday_day').val();
        var month = $('#birthday_month').val();
        var year = $('#birthday_year').val();
        var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];
        if($.trim(year) !== '') {
            if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0)) {
                monthLength[1] = 29;
            }
        }
        if($.trim(month) !== '') {
            var monthIndex = month - 1;
            var dayLength = monthLength[monthIndex];
            formatDay(dayLength, day);
        } else {
            if($.trim(day) === '') {
                formatDay(monthLength[0]);
            }
        }
    }

    function formatDay(number, daySelected)
    {
        var dayHtml = '<option value="">Ngày</option>';
        for(var i = 1; i <= number; i ++) {
            var k = i;
            if(i < 10) {
                k = '0'+i;
            }
            var selected = '';
            if(daySelected == k) {
                selected = 'selected="selected"';
            }
            dayHtml += '<option value="'+k+'" '+selected+'>'+k+'</option>';
        }
        $('#birthday_day').html(dayHtml);
    }
});