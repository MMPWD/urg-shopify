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
        // format: 'h:i A',
		format: 'H:i',
        formatSubmit: 'H:i',
        container: '#picker-container'
    });

    // check time of day and update login message

    if ($('#loginTODMessage').length) {    
        today = new Date()
        var day = today.getDay();
        var curHr = today.getHours();
        var curMin = today.getMinutes();
        
        if (curHr < 10) {
            curHr = "0" + curHr;
        }
        
        if (curMin < 10) {
            curMin = "0" + curMin;
        }
        
        var curTime = 0 + "." + curHr + curMin;
        var timeMessage = "";
        
        if (curTime >= 0.0000 && curTime < 0.1200) {
            timeMessage = "Good morning!";
        } else if (curTime >= 0.1200 && curTime < 0.1700) {
            timeMessage = "Good afternoon!";
        } else if (curTime >= 0.1700 && curTime < 0.2400) {
            timeMessage = "Good evening!";
        }
        
        document.getElementById("loginTODMessage").innerHTML = timeMessage;
    };

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

//# sourceMappingURL=app.js.map