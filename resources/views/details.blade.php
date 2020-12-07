@extends('layout')

@section('content')
    {{-- Details --}}
    <section id="details">
        <div class="container">
            <div class="row">
                {{-- Product Gallery --}}
                <div class="col-md-6">
                    <div class="details-image">
                        <img src="{{ $data->image }}" alt="image" class="img-resp img-general">
                    </div>
                    <div class="details-gallery">
                        <img src="{{ $data->image }}" alt="image" class="img-gallery">
                        @foreach ($gallery_images as $item)
                            <img src="{{ $item->src }}" alt="image" class="img-gallery">
                        @endforeach
                    </div>
                </div>
                {{-- Product Gallery end --}}

                {{-- Product Info --}}
                <div class="col-md-6">
                    <div class="details-info">
                        <h3><b>{{ $data->name }}</b></h3>
                        <small>Lorem ipsum dolor sit amet.</small>
                        @if ($data->discount > 0)
                        <?php
                            $total_price = $data->price - ($data->discount * $data->price / 100)
                        ?>
                        <h4><s>${{ $data->price }}</s> ${{ $total_price }} <small class="discount-percent bg-danger text-light">%{{ $data->discount }} Discounted</small></h4>
                        @else
                        <h4>${{ $data->price }}</h4>
                        @endif

                        
                        
                        <div class="mb-2">
                            <a href="#" class="text-warning"><i class="fas fa-star"></i></a>
                            <a href="#" class="text-warning"><i class="fas fa-star"></i></a>
                            <a href="#" class="text-warning"><i class="fas fa-star"></i></a>
                            <a href="#" class="text-warning"><i class="fas fa-star"></i></a>
                            <a href="#" class="text-warning"><i class="fas fa-star"></i></a>
                        </div>
                        <ul>
                            <li><b>Colors -</b> <i>{{ $data->colors }}</i></li>
                            <li><b>Display -</b> <i>{{ $data->display }}</i></li>
                            <li><b>Camera -</b> <i>{{ $data->camera }}</i></li>
                            <li><b>Memory -</b> <i>{{ $data->memory }}</i></li>
                            <li><b>RAM -</b> <i>{{ $data->ram }}</i></li>
                        </ul>
                        <div class="mt-3">
                            <button type="button" class="btn btn-primary">Add to cart</button>
                            <button type="button" class="btn btn-success">Buy now</button>
                        </div>
                        <hr>
                        <div class="detail-descr">{{ $data->descr }}</div>
                    </div>
                </div>
                {{-- Product Info end --}}

            </div>
        </div>
    </section>
    {{-- Details end --}}

    {{-- Comments --}}
    <section id="comments">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h3>Reviews</h3>
                    <hr>
                </div>

                {{-- Comment box --}}
                <div class="media media-comment">
                    <img src="https://cdn1.iconfinder.com/data/icons/avatar-97/32/avatar-02-512.png" class="mr-3 img-comment" alt="Avatar">
                    <div class="media-body">
                      <h5 class="mt-0">Media heading</h5>
                      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. 
                      Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. 
                      Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>
                {{-- Comment box end --}}

                {{-- Comment box --}}
                <div class="media media-comment">
                    <img src="https://www.shareicon.net/data/512x512/2017/01/06/868320_people_512x512.png" class="mr-3 img-comment" alt="Avatar">
                    <div class="media-body">
                      <h5 class="mt-0">Media heading</h5>
                      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. 
                      Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. 
                      Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>
                {{-- Comment box end --}}

                {{-- Comment box me --}}
                <div class="media media-comment media-comment-me">
                    <div class="media-body text-right">
                      <h5 class="mt-0">Media heading</h5>
                      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. 
                      Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. 
                      Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                    <img src="https://www.shareicon.net/data/512x512/2017/01/06/868320_people_512x512.png" class="ml-3 img-comment" alt="Avatar">
                </div>
                {{-- Comment box me end --}}

                <div class="col-12 mt-5">
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Leave a comment</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Write your review here, that's important for us..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>

            </div>
        </div>
    </section>
    {{-- Comments end --}}

    {{-- Similar products --}}
    <section id="similar">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h3>Similar products</h3>
                </div>
                <div class="col-12">
                    <div class="owl-carousel">

                        @foreach ($similar_products as $item)
                        <!-- Product -->
                        <div>
                            <a href="/details/{{ $item->id }}" class="product product-small">
                                <img src="{{ $item->image }}" alt="Image" class="img-resp">
                                <h5>{{ $item->name }}</h5>
                                @if ($item->discount > 0)
                                    <?php
                                    $total_price = $item->price - ($item->discount * $item->price / 100)
                                    ?>
                                    <span class="discounted">Discounted</span>
                                    Price - <b><s>${{ $item->price }}</s> <i>${{ $total_price }}</i></b>
                                @else
                                    Price - <b><i>${{ $item->price }}</i></b>
                                @endif
                            </a>
                        </div>
                        <!-- Product end -->
                        @endforeach

                    </div>
                </div>
                <div class="col-12 text-center mt-3">
                    <a href="/" class="btn btn-primary">All Procucts</a>
                </div>
            </div>
        </div>
    </section>
    {{-- Similar products end --}}

@endsection