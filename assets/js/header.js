(function($){
    "use strict"; 
    
    var mobile_nav = $(".mobile-nav"),
        inner = $(".inner-nav"),
        main_nav = $(".main-nav"),
        body = $("body");

    /* --------------------------------------------
        Default Classic Menu resize Window
    --------------------------------------------- */
    function init_classic_menu_resize() {

        // Mobile menu max height
        $(".mobile-on .inner-nav > ul").css("max-height", $(window).height() - main_nav.height() - 20 + "px");

        
        // Mobile menu style toggle
        if ($(window).width() <= 1024) {
            main_nav.addClass("mobile-on small-height");
            if(main_nav.hasClass("in-bottom-for-mobile")) {
                body.addClass("mobile-body-on");
            }
            $(".mobile-nav").addClass("small-height");
        } else if ($(window).width() > 1024) {
            if(main_nav.data("height") == "small") {
                $(this).addClass("small-height");
            } else {
                main_nav.removeClass("small-height");
            }
            main_nav.removeClass("mobile-on small-height");
            body.removeClass("mobile-body-on");
            inner.show();
        }
    }

    /* --------------------------------------------
        Init Default Classic Menu
    --------------------------------------------- */
    function init_classic_menu() {

        // change logo on sticky
        let logoclass = $('.sticky-logo-nav'),
            logopath = logoclass.attr("data-logosticky"),
            logolastpath = logoclass.attr("src");
        $('.sticky-logo-nav').attr('data-first', logolastpath);

        function changeLogoonscroll(opt) {
            if(opt == "scrollState" ) {
                logoclass.attr('src', logopath);
            } else if(opt == "normalState" ) {
                let oldpath = logoclass.attr("data-first");
                logoclass.attr('src', oldpath);
            }
        }

        // Navbar sticky
        $('.js-stick').on('sticky-start', function() { 
            if($(this).hasClass("sticky-state") && $(this).hasClass("sticky-state-with-subs")) {
                var navstate = $(this).attr("data-navstate"); 
                $(this).addClass(`fx-nav-state fx-nav-${navstate} fx-nav-state-subs fx-nav-${navstate}-subs`);
                // By default use dark mode if didn't defined state
                if(!navstate) {
                    $(this).addClass(`fx-nav-state fx-nav-dark fx-nav-state-subs fx-nav-dark-subs`);
                }
                //get sticky Logo 
                changeLogoonscroll("scrollState");

            } else if($(this).hasClass("sticky-state")) {
                // get Color Name from data attribute
                var navstate = $(this).attr("data-navstate"); 
                $(this).addClass(`fx-nav-state fx-nav-${navstate}`);
                // By default use dark mode if didn't defined state
                if(!navstate) {
                    $(this).addClass(`fx-nav-state fx-nav-dark`);
                }
                //get sticky Logo 
                changeLogoonscroll("scrollState");
            } 
        });
        $('.js-stick').on('sticky-end', function() { 
            if($(this).hasClass("sticky-state") && $(this).hasClass("sticky-state-with-subs")) {
                var navstate = $(this).attr("data-navstate"); 
                $(this).removeClass(`fx-nav-state fx-nav-${navstate} fx-nav-state-subs fx-nav-${navstate}-subs`);
                // By default use dark mode if didn't defined state
                if(!navstate) {
                    $(this).removeClass(`fx-nav-state fx-nav-dark fx-nav-state-subs fx-nav-dark-subs`);
                }
                //get sticky Logo 
                changeLogoonscroll("normalState");
            } else if($(this).hasClass("sticky-state")) {
                // get Color Name from data attribute
                var navstate = $(this).attr("data-navstate"); 
                $(this).removeClass(`fx-nav-state fx-nav-${navstate}`);
                // By default use dark mode if didn't defined state
                if(!navstate) {
                    $(this).removeClass(`fx-nav-state fx-nav-dark`);
                }
                //get sticky Logo 
                changeLogoonscroll("normalState");
            }
        });
        $(".js-stick").sticky({
            topSpacing: 0,
        });


        height_line($(".inner-nav ul > li > .menu-link"), main_nav);
        height_line(mobile_nav, main_nav);

        mobile_nav.css({
            "width": main_nav.height() + "px"
        });

        // Transpaner menu

        if (main_nav.hasClass("transparent")) {
            main_nav.addClass("js-transparent");
        }

        $(window).scroll(function () {
            if ($(window).width() > 1024) {
                if ($(window).scrollTop() > 50) {
                    $(".js-transparent").removeClass("transparent");
                    if(main_nav.data("height") == "small") {
                        $(".main-nav, .nav-logo-wrap .logo, .mobile-nav").addClass("small-height");
                    } else {
                        main_nav.removeClass("small-height");
                    }
                } else {
                    $(".js-transparent").addClass("transparent");
                    $(".main-nav, .nav-logo-wrap .logo, .mobile-nav").removeClass("small-height");
                }
            }
        });

        // Mobile menu toggle
        mobile_nav.click(function () {
            if (inner.hasClass("js-opened")) {
                inner.slideUp("slow", "easeOutExpo").removeClass("js-opened");
                $(this).removeClass("active");
                body.removeClass("js-opened");
            } else {
                inner.slideDown("slow", "easeOutQuart").addClass("js-opened");
                $(this).addClass("active");
                body.addClass("js-opened");
            }

        });

        inner.find("a:not(.mn-has-sub)").click(function () {
            if (mobile_nav.hasClass("active")) {
                inner.slideUp("slow", "easeOutExpo").removeClass("js-opened");
                mobile_nav.removeClass("active");
            }
        });


        // Sub menu
        var mnHasSub = $(".mn-has-sub");
        var mnThisLi;

        mnHasSub.click(function () {
            
            if (main_nav.hasClass("mobile-on")) {
                mnThisLi = $(this).parent("li:first");
                if (mnThisLi.hasClass("js-opened")) {
                    mnThisLi.find(".mn-sub:first").slideUp(function () {
                        mnThisLi.removeClass("js-opened");
                    });
                } else {
                    mnThisLi.addClass("js-opened");
                    mnThisLi.find(".mn-sub:first").slideDown(); 
                }

                return false;
            } else {
                return false;
            } 
        });

        mnThisLi = mnHasSub.parent("li");
        mnThisLi.hover(function () {

            if (!(main_nav.hasClass("mobile-on"))) {
                $(this).find(".mn-sub:first").stop(true, true).fadeIn("fast");
            }

        }, function () {

            if (!(main_nav.hasClass("mobile-on"))) {
                $(this).find(".mn-sub:first").stop(true, true).delay(100).fadeOut("fast");
            }

        });

    }

    /* --------------------------------------------
        Block height 100%
    --------------------------------------------- */ 
    function height_line(height_object, height_donor) {
        height_object.height(height_donor.height());
        height_object.css({
            "line-height": height_donor.height() + "px"
        });
    }

    $(document).ready(function(){ 
        init_classic_menu(); 
    });
    $(window).on('resize', function(){
        init_classic_menu_resize();
    });

})(jQuery); // End of use strict