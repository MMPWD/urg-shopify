$(function () {
    $(".sidebar-button").click(function () {
        $(".sidebar-wrapper").toggleClass("closed");
        if ($(".sidebar-wrapper").hasClass("closed")) {
            $(this).addClass("closed")
        } else {
            $(this).removeClass("closed")
        }
    });
});

var resizing = false;

function doResize() {
    var w = $(window).innerWidth();

    if (w < 800) {
        $('.sidebar-wrapper').addClass('closed');
        $('.sidebar-button').addClass('closed');
    } else {
        $('.sidebar-wrapper').removeClass('closed');
        $('.sidebar-button').removeClass('closed');
        $('.off-canvas').foundation('close');
    }
}

$(window).resize(function (e) {
    //use timeouts not to trigger event constantly
    if (resizing !== false) {
        clearTimeout(resizing);
    }
    resizing = setTimeout(doResize, 200);
});


$(document).ready(function () {

    $(document).foundation();

    $('.dropit-menu').dropit({
        action: 'click'
    });

    $('.datepicker').pickadate({
        format: 'd mmmm yyyy',
        container: '#picker-container'
    });

    $('.timepicker').pickatime({
        clear: 'Closed',
        format: 'h:i A',
        formatSubmit: 'H:i',
        container: '#picker-container'
    });

});


// Keep footer atleast at bottom of page
window.onresize = function (event) {


    clearTimeout($.data(this, 'resizeTimer'));


    $.data(this, 'resizeTimer', setTimeout(function () {

        resizeFooter();

    }, 20));

};


function resizeFooter() {
    var footerHeight = $('footer').height();
    var footerMargin = parseInt($('footer').css('margin-top'));
    var footerTotal = footerHeight + footerMargin;

    var contentHeight = $('.page-wrapper').height();

    var windowHeight = $(window).height();
    var windowHeightMinusFooterTotal = windowHeight - footerTotal;

    var browserHeight = $(document).height();
    var browserMinusFooter = browserHeight - footerHeight;
    var browserMinusFooterTotal = browserHeight - footerTotal;


    if (windowHeight > (contentHeight + footerHeight)) {
        if (browserMinusFooterTotal >= contentHeight) {
            if (windowHeightMinusFooterTotal < browserMinusFooterTotal) {
                var marginToUse = footerMargin - (browserMinusFooterTotal - windowHeightMinusFooterTotal);
            } else {
                var marginToUse = browserMinusFooter - contentHeight;
            }
        }
    } else {
        var marginToUse = 40;
    }

    $('footer').css('margin-top', marginToUse);


}


$(window).load(function () {
    resizeFooter();
});
