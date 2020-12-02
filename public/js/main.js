$(function(){

    // Components
    $(".owl-carousel").owlCarousel({
        loop: true,
        responsive:{
            0:{
                items: 3
            },
            768:{
                items: 4
            },
            992:{
                items: 6
            }
        }
    });

    // Details gallery images
    $('.img-gallery').on('click', function(){
        var src = $(this).attr('src');
        $('.details-image').find('.img-general').attr('src', src);
    }); 
    
});