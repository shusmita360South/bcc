jQuery(document).ready(function($) {

    //=============hero slider=========================================
    var $heroSlider = $(".hero-slider");
    $heroSlider.owlCarousel({
        items: 1,
        //autoplay: true,
        autoplayTimeout: 4000,
        mouseDrag: false,
        touchDrag: false,
        dots: true,
        dotsData: true,
        loop: true,
        nav: true,
        navText: [
           "<span aria-label='Previous'><svg xmlns='http://www.w3.org/2000/svg' width='5.399' height='8.645' viewBox='0 0 5.399 8.645'><defs><style>.arrow{fill:#FFFFFF;stroke:#FFFFFF;}</style></defs><g transform='translate(32.926 19.081) rotate(-90)'><path class='arrow' d='M3.174,10.781l-.393.393L6.2,14.593l.2.188.2-.188,3.419-3.419-.393-.393L6.4,14Z' transform='translate(8.362 -43)'/></g></svg></span>",
           "<span aria-label='Next'><svg xmlns='http://www.w3.org/2000/svg' width='5.399' height='8.645' viewBox='0 0 5.399 8.645'><defs><style>.arrow{fill:#FFFFFF;stroke:#FFFFFF;}</style></defs><g transform='translate(32.926 19.081) rotate(-90)'><path class='arrow' d='M3.174,10.781l-.393.393L6.2,14.593l.2.188.2-.188,3.419-3.419-.393-.393L6.4,14Z' transform='translate(8.362 -43)'/></g></svg></span>"
        ],
        slideTransition: 'fade',
        onChanged: onChangedHero,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn'
    });

    $('.hero-slider .owl-dot').click(function() {
        $heroSlider.trigger('to.owl.carousel', [$(this).index(), 1000]);
        $('.hero-slider .owl-item.active video').get(0).play();
        $heroSlider.trigger('stop.owl.autoplay');

        $heroSlider.trigger('play.owl.autoplay');

    })
    function onChangedHero(program) {
       var current = program.currentTarget;

       setTimeout(function(){
       $('.hero-slider .owl-item.active video').get(0).play();
       },1);
    }


    // ===========================================================
    // connect program carousel
    // ===========================================================

    $('.owl-carousel.connect-program-carousel').owlCarousel({
        loop:false,
        margin:30,
        nav: true,
        navText: [
           "<span aria-label='Previous'><svg xmlns='http://www.w3.org/2000/svg' width='5.399' height='8.645' viewBox='0 0 5.399 8.645'><defs><style>.arrow{fill:#FFFFFF;stroke:#FFFFFF;}</style></defs><g transform='translate(32.926 19.081) rotate(-90)'><path class='arrow' d='M3.174,10.781l-.393.393L6.2,14.593l.2.188.2-.188,3.419-3.419-.393-.393L6.4,14Z' transform='translate(8.362 -43)'/></g></svg></span>",
           "<span aria-label='Next'><svg xmlns='http://www.w3.org/2000/svg' width='5.399' height='8.645' viewBox='0 0 5.399 8.645'><defs><style>.arrow{fill:#FFFFFF;stroke:#FFFFFF;}</style></defs><g transform='translate(32.926 19.081) rotate(-90)'><path class='arrow' d='M3.174,10.781l-.393.393L6.2,14.593l.2.188.2-.188,3.419-3.419-.393-.393L6.4,14Z' transform='translate(8.362 -43)'/></g></svg></span>"
        ],
        autoHeight:false,
        responsive:{
            0:{
                items:1
            },
            470:{
                items:2
            },
            800:{
                items:3
            },
            1000:{
                items:4
            }
        }
    })


    // ===========================================================
    // connect group carousel
    // ===========================================================

    $('.owl-carousel.connect-group-carousel').owlCarousel({
        loop:false,
        margin:30,
        nav: true,
        dots:false,
        navText: [
           "<span aria-label='Previous'><svg xmlns='http://www.w3.org/2000/svg' width='5.399' height='8.645' viewBox='0 0 5.399 8.645'><defs><style>.arrow{fill:#FFFFFF;stroke:#FFFFFF;}</style></defs><g transform='translate(32.926 19.081) rotate(-90)'><path class='arrow' d='M3.174,10.781l-.393.393L6.2,14.593l.2.188.2-.188,3.419-3.419-.393-.393L6.4,14Z' transform='translate(8.362 -43)'/></g></svg></span>",
           "<span aria-label='Next'><svg xmlns='http://www.w3.org/2000/svg' width='5.399' height='8.645' viewBox='0 0 5.399 8.645'><defs><style>.arrow{fill:#FFFFFF;stroke:#FFFFFF;}</style></defs><g transform='translate(32.926 19.081) rotate(-90)'><path class='arrow' d='M3.174,10.781l-.393.393L6.2,14.593l.2.188.2-.188,3.419-3.419-.393-.393L6.4,14Z' transform='translate(8.362 -43)'/></g></svg></span>"
        ],
        autoHeight:false,
        responsive:{
            0:{
                items:1
            },
            470:{
                items:2
            },
            800:{
                items:3
            },
            1000:{
                items:4
            }
        }
    })

    

    // ===========================================================
    // magnific popup
    // Video popup
    // ===========================================================
    $('.video-btn').magnificPopup({
      type: 'iframe',
      iframe: {
         markup: '<div class="mfp-iframe-scaler">'+
                    '<div class="mfp-close"></div>'+
                    '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
                    '<div class="mfp-title">Some caption</div>'+
                  '</div>'
      },
      callbacks: {
        markupParse: function(template, values, item) {
         values.title = item.el.attr('title');
        }
      }
    });

    // ===========================================================
    // Contact form Validation
    // ===========================================================
    $("#contactform").validate();
    $("#regform").validate();



    // ===========================================================
    // submenu dropdown on mouseover
    // ===========================================================
    var submenuParentLink = $( '#menu-mainmenu > li a');
    $(submenuParentLink).on('click', function (e) {
        if ($(this).next('.sub-menu').length && $(this).attr("rel") != "testcomm") {
            e.prprogramDefault();
        }
    });

    //=============================================================
    //================program Filter==============================
    //=============================================================

    $('.program-filter .filter-select').on('change', function() {
        var filterClass =$(this).val();
        if (filterClass == "") {
            $('.program-card-outer').show();
        } else {
            $('.program-card-outer').hide();
            $('.program-card-outer.'+filterClass).show();
        }  
        var otherSelectBox = $(".program-filter .filter-select").not(this);
            
        if (filterClass != "") {
            otherSelectBox.addClass('otherSelectBox');
            $(this).removeClass('otherSelectBox');
            setTimeout(function(){
                $('.otherSelectBox').prop('selectedIndex',0);
                
            }, 100);
        }

    });
    

   
    // ===========================================================
    // scroll
    // ===========================================================
    var previousScroll = 0;
    $(window).scroll(function() {
        if (isMobile() == false) {
            if ($(window).scrollTop()<220) {
                $("header").removeClass("scrolled");
                $("header .logo img").attr("src", "/img/logo.svg");

                if($(".header-block-1").length) {
                    $(".header-block-1").removeClass("scrolled");
                }
            } else {
                $("header").addClass("scrolled");
                $("header .logo img").attr("src", "/img/logo-small.png");

                if($(".header-block-1").length) {
                    $(".header-block-1").addClass("scrolled");
                }
            }
        } else {
            var currentScroll = $(this).scrollTop();

            if (currentScroll > previousScroll){
                $("header").removeClass("scrolledMobile");
            } else {
                $("header").addClass("scrolledMobile");
            }
            
            previousScroll = currentScroll;
        }

    });

    //=============================================================
    //================not close click=================================
    //=============================================================
    
    $('.bottom-note .close').click(function() {
        $('.bottom-note').addClass('hide');
    });

    //=============================================================
    //================Mobile menu==================================
    //=============================================================
    $('.uk-offcanvas .menu-item .sub-menu').addClass('hide');
    $('.uk-offcanvas .menu-item-has-children > a').on('click', function(program) {
        program.prprogramDefault();
        $(this).parent().toggleClass('expanded');
        $(this).next().toggleClass('hide');
    });

    //=============================================================
    //================Is Mobile==================================
    //=============================================================
    function isMobile(width) {
        if(width == undefined){
            width = 719;
        }
        if(window.innerWidth <= width) {
            return true;
        } else {
            return false;
        }
    }

    // ===========================================================
    // animation on url hash element
    // ===========================================================
    $(".scroll-animation").on('click', function(program) {
        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
            // Store hash
            var hash = this.hash;
            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
            $('html, body').animate({
                scrollTop: $(hash).offset().top - 100
                }, 500, function() {
                // Add hash (#) to URL when done scrolling (default click behavior)
                //window.location.hash = hash;
            });
            return false;
        } // End if
    });
    if ($(window.location.hash).length > 0) {
        var hash = window.location.hash;

        window.location.hash = "";

        $('html, body').animate({
            scrollTop: $(hash).offset().top - 100
        }, 500, function() {
            // Add hash (#) to URL when done scrolling (default click behavior)
            //window.location.hash = hash;
        });
    }   

});
