$(function(){

    // Owl Carousel
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


    // Notifications disapearing
    if($('.alert')){
        setTimeout(function(){
            $('.alert').fadeOut(500);
        }, 5000);
    }

    // DropDown
    $('.dropdown-toggle').dropdown();

    // // Tooltips
    // var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    // var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    // return new bootstrap.Tooltip(tooltipTriggerEl)
    // })

    // // Nav tabs
    // var triggerTabList = [].slice.call(document.querySelectorAll('#myTab a'))
    // triggerTabList.forEach(function (triggerEl) {
    //     var tabTrigger = new bootstrap.Tab(triggerEl)

    //     triggerEl.addEventListener('click', function (event) {
    //         event.preventDefault()
    //         tabTrigger.show()
    //     })
    // })

    $('.nav-tabs .nav-link').on('click', function(){
        $('.nav-tabs .nav-link.active').removeClass('active');
        $(this).addClass('active');
        var target = $(this).attr('href');
        $('.tab-content .tab-pane.show.active').removeClass('active');
        $('.nav-tabs .tab-pane.show').removeClass('show');
        $(target).addClass('show');
        $(target).addClass('active');
        // Save in local storage
        if(window.localStorage.getItem('nav-tab')){
            window.localStorage.removeItem('nav-tab');
            window.localStorage.setItem('nav-tab', $('.tab-content .tab-pane.show.active').attr('id'));
        }else{
            window.localStorage.setItem('nav-tab', $('.tab-content .tab-pane.show.active').attr('id'));
        }
    });

    // Nav-tab when page updates
    if(window.localStorage.getItem('nav-tab') != null){
        var targetId = '#' + window.localStorage.getItem('nav-tab');
        $('.nav-tabs .nav-link.active').removeClass('active');
        $('.nav-tabs .nav-link[href="' + targetId + '"]').addClass('active');
        $('.tab-content .tab-pane.show.active').removeClass('active');
        $('.nav-tabs .tab-pane.show').removeClass('show');
        $(targetId).addClass('show');
        $(targetId).addClass('active');
    }
    
});