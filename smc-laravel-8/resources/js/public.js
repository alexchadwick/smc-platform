/*
*
* public,js */


import 'bootstrap-icons/font/bootstrap-icons.css';
import 'owl.carousel/dist/assets/owl.carousel.css';
import 'owl.carousel/dist/assets/owl.theme.default.css';
import 'owl.carousel';

$(document).ready(function(){
    //Testimonials

    //Init carousel
    $('.carousel-testimonials').owlCarousel(
        {
            nav:true,
            margin:15,
            loop:true,
            center: true,
            items:1,
            autoplay:true,
            autoplayTimeout:4000,
            autoplayHoverPause:true
        }

    );

    //Awards
    //Init carousel

    $('.carousel-awards').owlCarousel(
        {
            nav:true,
            margin:15,
            loop:true,
            center: true,
            items:5,
            autoplay:true,
            autoplayTimeout:4000,
            autoplayHoverPause:true,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                600:{
                    items:3,
                    nav:false
                },
                1000:{
                    items:5,
                    nav:true,
                    loop:false
                }
            }
        }

    );

});


