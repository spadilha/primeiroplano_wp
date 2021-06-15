/*
    Spadilha Scripts
    Author: Saulo Padilha
*/

jQuery(function($){

    window.WebApp = {

        // INIT
        init: function() {

            var self = this;

            WebApp.banners();
            WebApp.navigations();

            if($('.fitvidz').length){
                $('.fitvidz').fitVids();
            }

        },

        banners: function(){

            $('.banners-container').on('init', function(slick){
                $('#banners').addClass('active');
            });

            $('.banners-container').slick({
                autoplay: true,
                autoplaySpeed: 6000,
                pauseOnHover: true,
                dots: true,
                arrows: false,
                speed: 700,
                slidesToShow: 1,
                touchThreshold: 20,
                slidesToScroll: 1,
            });
        },

        navigations: function(){

            $('.hamburger').on('click touch', function(){
                $(this).toggleClass('is-active');
                $('#menu-mobile').toggleClass('opened');
            });

            $('#icoLuzes').on('click touch', function(){
                $('#menu-topbar').toggleClass('opened');
            });




            $('.btn-search').on('click touch', function(){
                $('#search').toggleClass('active');
                $('#search .searchField').focus();
            });

            $(document).on('click', function(event) {

                // console.log(event.target);

                if (!$(event.target).closest('#menu-mobile, #menuIcon').length) {
                    $('#menu-mobile').removeClass('opened');
                }

                if (!$(event.target).closest('#menu-topbar, #icoLuzes').length) {
                    $('#menu-topbar').removeClass('opened');
                }

                if (!$(event.target).closest('.btn-search, #search').length) {
                    $('#search').removeClass('active');
                }

                if (!$(event.target).closest('#newsletter').length) {
                    $('#newsletter .formHidden').animate({'height': '0px'}, 300);
                    $('#newsletter .wpcf7-response-output').hide();
                    $('input').removeClass('wpcf7-not-valid file-not-valid');
                }

            });
        },

        shareButtons: function(){

            // SOCIAL MEDIA
            $('.shareFacebook').click(function(e){
                e.preventDefault();
                url = $(this).attr('href');
                window.open('http://www.facebook.com/sharer.php?u=' + url ,"pop","menubar=1,resizable=1,width=665,height=355");
            });
            $('.shareTwitter').click(function(e){
                e.preventDefault();
                url = $(this).attr('href');
                var title = $(this).attr('title');
                window.open(url,"pop","menubar=1,resizable=1,width=660,height=500");
            });
        },
    };

    WebApp.init();

}); /* end of as page load scripts */
