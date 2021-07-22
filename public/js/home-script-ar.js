$('#banner').owlCarousel({
    loop:true,
    nav:true,
    // autoplay:true,
    rtl : true,
	// autoplayTimeout:4000,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});
$('#car-rental-video').owlCarousel({
    loop:true,
    nav:true,
    // autoplay:true,
    rtl : true,
	// autoplayTimeout:4000,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});
$( ".owl-prev").html('<i class="fa fa-chevron-right"></i>');
$( ".owl-next").html('<i class="fa fa-chevron-left"></i>');