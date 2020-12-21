<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
<!-- Optional -->
<script src="/components/fontawesome/js/all.js"></script>
<script src="/components/owlcarousel/js/owl.carousel.min.js"></script>
<!-- Main js -->
<script src="/js/main.js"></script>
<script>
    $(function(){
        // Setup ajax csrf
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Comments sneding ajax form
        $('#comments-form').on('submit', function(e){
            // Default settings
            e.preventDefault();

            var form = $(this);

            // Take all required datas
            var productId = $(form).find('input[name="product_id"]').val();
            var comment = $(form).find('textarea[name="comment"]').val();

            // Send datas to backend
            $.ajax({
                url: "{{ route('ajax.request.sendcomment') }}",
                type: "POST",
                data: {productId: productId, comment: comment},
                beforeSend: function(){
                    $(form).find('button[type="submit"]').prop('disabled', true);
                },
                success: function(data_sending_comments){
                    $(form).find('button[type="submit"]').prop('disabled', false);
                    $(form).find('#exampleFormControlTextarea1').val('');
                }
            })
        });

        // Comments getting ajax
        var comCounter = 5;
        if($('#comments')){
            setInterval(function(){
                loadComments(comCounter);
            }, '1000');
        }

        // Load more comments
        $('.btn-load-comments').on('click', function(){
            comCounter += 3;
            loadComments(comCounter);
        });
        
    })

    function loadComments(comCounter){
        $.post("{{ route('ajax.request.getcomment') }}", function(data_getting_comments){
            var allComments = '';
            if(data_getting_comments['comments'].length <= 5 || data_getting_comments['comments'].length <= comCounter){
                comCounter = data_getting_comments['comments'].length;
                $('.btn-load-comments').fadeOut();
            }else{
                $('.btn-load-comments').fadeIn();
            }

            for(i = 0; i < comCounter; i++){
                if(data_getting_comments['comments'][i].admin_id == '0'){
                    // var firstName = data_getting_comments['comments'][i].first_name;
                    // var image = data_getting_comments['comments'][i].personal_image;  
                    var firstName = "USER";
                    var image = 'https://cdn1.iconfinder.com/data/icons/avatar-97/32/avatar-02-512.png'; 
                    for(f = 0; f < data_getting_comments['users'].length; f++){
                        if(data_getting_comments['comments'][i].user_id == data_getting_comments['users'][f]['id']){
                            var firstName = data_getting_comments['users'][f]['first_name'];
                            var image = data_getting_comments['users'][f]['personal_image']; 
                        }
                    }
                     
                }else{
                    var firstName = "ADMIN"
                    var image = 'https://i.pinimg.com/736x/5f/40/6a/5f406ab25e8942cbe0da6485afd26b71.jpg';   
                }
                var comment = data_getting_comments['comments'][i].comment;
                var date = data_getting_comments['comments'][i].date;

                if((data_getting_comments['current_user'] == data_getting_comments['comments'][i].user_id && data_getting_comments['current_user'] != '0') || (data_getting_comments['current_admin'] == data_getting_comments['comments'][i].admin_id && data_getting_comments['current_admin'] != '0')){
                    var content = '<div class="col-12"><div class="media media-comment media-comment-me"><div class="media-body text-right"><h6 class="mt-0"><b>' + firstName + '</b></h6>' + comment + '</div><div class="comment-image ml-2"><img src="' + image + '" alt="Avatar"></div></div><div class="comment-date mt-2 text-right">' + date + '</div></div>';
                }else{
                    var content = '<div class="col-12"><div class="media media-comment media-comment-other"><div class="comment-image mr-2"><img src="' + image + '" alt="Avatar"></div><div class="media-body"><h6 class="mt-0"><b>' + firstName + '</b></h6>' + comment + '</div></div><div class="comment-date mt-2">' + date + '</div></div>';
                }

                allComments += content;
            }
            $('#details-comments').html(allComments);

            if(data_getting_comments['comments'].length < 1){
                $('#details-comments').html('<div class="col-12 text-center"><h4>No reviews yet.</h4></div>');
            }
        });
    }
</script>