(function($) {
    "use strict";
    $(document).ready(function() {
        var a = $(".khb-mobilenav");
        a.length && (a.children("li").addClass("menu-item-parent"), a.find(".menu-item-has-children > a").on("click", function(e) {
            e.preventDefault();
            $(this).toggleClass("opened");
            var n = $(this).next(".sub-menu"),
                s = $(this).closest(".menu-item-parent").find(".sub-menu");
            a.find(".sub-menu").not(s).slideUp(250), n.slideToggle(250)
        }));
        $('.khbtap').on('click', function() {
            $('html').removeClass('menu-is-closed').addClass('menu-is-opened');
        });
        $('.menu-close, .click-capture').on('click', function() {
            $('html').removeClass('menu-is-opened').addClass('menu-is-closed');
        });
        $('.toggle-overlay').on('click', function() {
            $('.search-body').toggleClass('search-open');
        });

        $('.testi-carousel').owlCarousel({
            loop:true,
            margin:50,
            nav:false,
            dots:false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:3
                }
            }
        });

        $('.author-carousel').owlCarousel({
            loop:true,
            margin:50,
            nav:false,
            dots:false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:3
                }
            }
        });
        
    });
})(jQuery);