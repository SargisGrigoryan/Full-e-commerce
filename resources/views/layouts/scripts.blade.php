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
                }
            })
        });

        // Comments getting ajax
        if($('#comments')){
            setInterval(function(){
                $.post("{{ route('ajax.request.getcomment') }}", function(data_getting_comments){
                    var allComments = '';
                    for(i = 0; i < data_getting_comments['comments'].length; i++){
                        var firstName = data_getting_comments['comments'][i].first_name;
                        var image = data_getting_comments['comments'][i].personal_image;
                        var comment = data_getting_comments['comments'][i].user_comment;
                        var date = data_getting_comments['comments'][i].date;

                        if(data_getting_comments['current_user']['id'] == data_getting_comments['comments'][i].id){
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
            }, '1000');
        }
        
    })
</script>