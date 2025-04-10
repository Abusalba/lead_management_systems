var $ = jQuery.noConflict();

jQuery(document).ready(function($){

 /*==========================*/
    /* sliders */
    /*==========================*/
    if ($('._hero_slider').length > 0) {
        jQuery('._hero_slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: false,
            arrows: true,
            vertical: true,
            centerMode: true, 
            verticalSwiping: true,
            // autoplay: true,
            // autoplaySpeed: 3000,
            speed: 500,
            infinite: true,
            centerMode: false,
            responsive: [{
                breakpoint: 767,
                settings: {
                    arrows: false,
                }
            }]

        });
    }

    /*==========================*/


/*==========================*/
    /* sliders */
    /*==========================*/
    if ($('.service-tab-slider').length > 0) {
        jQuery('.service-tab-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: false,
            arrows: true,
            fade: false,
            autoplay: true,
            autoplaySpeed: 3000,
            speed: 500,
            infinite: true,
            centerMode: false,

        });
        // Reinitialize slick slider on tab show
        $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            $('.service-tab-slider').slick('setPosition');
        });
    }

    /*==========================*/  
/*==========================*/ 
/* sliders */ 
/*==========================*/
if($('.product-sldier').length > 0){
jQuery('.product-sldier').slick({
  slidesToShow: 4,
  slidesToScroll: 2,
  dots: false,
  arrows: true, 
  infinite: true, 
  centerMode: false,
  responsive: [
    {
      breakpoint: 992,
      settings: {
        arrows: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,  
      }
    },
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: false,  
      }
    },
    {
      breakpoint: 575,
      settings: {
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,  
      }
    }
  ] 
   
});
}    


/*==========================*/ 
/* sliders */ 
/*==========================*/
if($('.project-sldier').length > 0){
jQuery('.project-sldier').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  dots: false,
  arrows: true, 
  infinite: true, 
  centerMode: false,
  responsive: [
    {
      breakpoint: 992,
      settings: {
        arrows: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,  
      }
    },
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: false,  
      }
    },
    {
      breakpoint: 575,
      settings: {
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,  
      }
    }
  ] 
   
});
}   



/*==========================*/ 
/* sliders */ 
/*==========================*/
if($('._partner_slider').length > 0){
jQuery('._partner_slider').slick({
  slidesToShow: 5,
  slidesToScroll: 1,
  dots: false,
  arrows: false, 
  autoplay:true,
  autoplaySpeed: 0,
  cssEase: 'linear',
  speed: 3000,
  infinite: true, 
    responsive: [
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 4,
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
        }
      },
    ]
   
});
}       


    
 
/*==========================*/  
/* Mobile Slider */  
/*==========================*/ 
if($('.mobile-slider').length > 0){
jQuery('.mobile-slider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  dots: true,
  arrows: false, 
  infinite: true, 
  centerMode: false, 
  responsive: [
    {
      breakpoint: 5000,
      settings: "unslick"
    },
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,  
        adaptiveHeight: false
      }
    }
  ]
});
}
 

/*==========================*/  
/* Scroll on animate */  
/*==========================*/
function onScrollInit( items, trigger ) {
  items.each( function() {
    var osElement = $(this),
        osAnimationClass = osElement.attr('data-os-animation'),
        osAnimationDelay = osElement.attr('data-os-animation-delay');
        osElement.css({
          '-webkit-animation-delay':  osAnimationDelay,
          '-moz-animation-delay':     osAnimationDelay,
          'animation-delay':          osAnimationDelay
        });
        var osTrigger = ( trigger ) ? trigger : osElement;
        osTrigger.waypoint(function() {
          osElement.addClass('animated').addClass(osAnimationClass);
          },{
              triggerOnce: true,
              offset: '95%',
        });
// osElement.removeClass('fadeInUp');
  });
}
onScrollInit( $('.os-animation') );
onScrollInit( $('.staggered-animation'), $('.staggered-animation-container'));

/*==========================*/
/* Header fix */
/*==========================*/
var scroll = $(window).scrollTop();
if (scroll >= 10) {
    $("body").addClass("fixed");
} else {
    $("body").removeClass("fixed");
}


});


$(window).scroll(function() {
    var scroll = $(window).scrollTop();
    if (scroll >= 10) {
        $("body").addClass("fixed");
    } else {
        $("body").removeClass("fixed");
    }
});



$(document).ready(function() {
    $('.popup-link').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true // Enable gallery mode for group of images
        }
    });
});