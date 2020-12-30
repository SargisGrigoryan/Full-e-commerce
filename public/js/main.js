$(function(){

    // Owl Carousel
    $(".owl-carousel").owlCarousel({
        loop: true,
        responsive:{
            0:{
                items: 3
            },
            992:{
                items: 4
            },
            1600:{
                items: 6
            }
        }
    });

    // Details gallery images
    $('.img-gallery').on('click', function(){
        var src = $(this).attr('src');
        $('.details-image').find('.img-general').attr('src', src);
    }); 


    // Notifications disapearing
    if($('.alert')){
        setTimeout(function(){
            $('.alert').fadeOut(500);
        }, 5000);
    }

    // DropDown
    // $('.dropdown-toggle').dropdown();
    $('.dropdown').on('click', function(){
        $(this).toggleClass('show');
        $(this).find('.dropdown-menu').toggleClass('show');
    })

    // Details add to cart and buy now qty and color
    if($('#qty_input') || $('#color_input')){
        var targetQty = $('form[action="addToCart"]').find('input[name="qty"]');
        var targetColor = $('form[action="addToCart"]').find('select[name="color"]');

        targetQty.on('change', function(){
            var value = $(this).val();
            $('#qty_input').val(value);
        });
        targetColor.on('change', function(){
            var value = $(this).val();
            $('#color_input').val(value);
        });
        $('#qty_input').val(targetQty.val());
        $('#color_input').val(targetColor.val());
    }

    // Tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
});