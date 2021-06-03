/*
    Spadilha Scripts
    Author: Saulo Padilha
*/

jQuery(function($){

    window.CasaApp = {

        // INIT
        init: function() {

            var self = this;

            CasaApp.setHeader();
            $(window).scroll(function(){
                CasaApp.setHeader();
            });
            $(window).resize(function(){
                CasaApp.setHeader();
            });

            CasaApp.navigations();


            if($('.fitvidz').length){
                $('.fitvidz').fitVids();
            }

            // Open Newsletter
            $('#newsletter .newsletter-email').focus(function(){
                $('#newsletter .formHidden').animate({'height': '220px'}, 600);
            });

        },

        navigations: function(){

            // ADICIONA SELECTED-LAVA NO MENU ANTES DE DISPARAR O SCRIPT
            $('.current_page_parent').addClass('selectedLava');
            $('#menu > ul > .current-menu-item').addClass('selectedLava');

            // DISPARA O LAVALAMP
            $('#menu > ul').lavaLamp({
                target: 'li',
                speed: 400,
                returnDelay: 1000,
            });


            // Menu Mobile
            // $('.menuIcon').on('click touch', function(){
            //     $('#menu').toggleClass('opened');
            // });

            $('.hamburger').on('click touch', function(){
                $(this).toggleClass('is-active');
                $('#menu').toggleClass('opened');
            });


            $('.btn-busca').on('click touch', function(){
                $('#busca').toggleClass('active');
                $('#busca .searchField').focus();
            });


            $('#menu > ul > li > a').on('mouseover click touch', function(e){

                if($(this).parent().hasClass('menu-item-has-children')){
                    e.preventDefault();
                    $('#busca').removeClass('active');
                    $(this).next('ul').show();
                } else {
                    CasaApp.hideSubMenu();
                }
            });

            $('#header').on('mouseleave', function(e){
                e.preventDefault();
                CasaApp.hideSubMenu();
            });

            $(document).on('click', function(event) {

                // console.log(event.target);

                if (!$(event.target).closest('#menu, .menuIcon').length) {
                    $('.menu, .menu-item-has-children ul').hide();
                }

                if (!$(event.target).closest('.btn-busca, #busca').length) {
                    $('#busca').removeClass('active');
                }

                if (!$(event.target).closest('#newsletter').length) {
                    $('#newsletter .formHidden').animate({'height': '0px'}, 300);
                    $('#newsletter .wpcf7-response-output').hide();
                    $('input').removeClass('wpcf7-not-valid file-not-valid');
                }

                // if(windowWidth < 1211){
                //  if (!$(event.target).closest('.side-button, .side-nav').length) {
                //      $('.side-nav').stop().animate({'left': '-264px'}, 500);
                //  }
                // }
            });
        },

        hideSubMenu: function(){
            $('.menu-item-has-children ul').hide();
        },

        setHeader: function(){

            var disTop = 300;

            if($(document).scrollTop() > disTop){
                $('#header, #busca').addClass('small');
            } else {
                $('#header, #busca').removeClass('small');
            }

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

    CasaApp.init();

}); /* end of as page load scripts */
