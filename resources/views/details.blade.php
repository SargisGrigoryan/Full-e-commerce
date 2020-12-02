@extends('layout')

@section('content')

    {{-- Details --}}
    <section id="details">
        <div class="container">
            <div class="row">

                {{-- Product Gallery --}}
                <div class="col-md-6">
                    <div class="details-image">
                        <img src="https://icdn2.digitaltrends.com/image/aem/aem-2020-7-3-dc6bd6650daf4630691cbe11c37b7b42bf0a30e9-500x500.png" alt="image" class="img-resp img-general">
                    </div>
                    <div class="details-gallery">
                        <img src="https://icdn2.digitaltrends.com/image/aem/aem-2020-7-3-dc6bd6650daf4630691cbe11c37b7b42bf0a30e9-500x500.png" alt="image" class="img-gallery">
                        <img src="https://cdn.gsmarena.com/imgroot/news/18/05/aquaris-x2-x2pro/-500/gsmarena_003.jpg" alt="image" class="img-gallery">
                        <img src="https://www.eutronix.nl/wp-content/uploads/2019/09/PM90-front-view-500x500.jpg" alt="image" class="img-gallery">
                        <img src="https://www.swissphone.com/wp-content/uploads/2019/05/SOS-Mobile-App_EN.jpg" alt="image" class="img-gallery">
                    </div>
                </div>
                {{-- Product Gallery end --}}

                {{-- Product Info --}}
                <div class="col-md-6">
                    <div class="details-info">
                        <h3><b>Product name</b></h3>
                        <small>Lorem ipsum dolor sit amet.</small>
                        <h4>$150</h4>
                        <div class="mb-2">
                            <a href="#" class="text-warning"><i class="fas fa-star"></i></a>
                            <a href="#" class="text-warning"><i class="fas fa-star"></i></a>
                            <a href="#" class="text-warning"><i class="fas fa-star"></i></a>
                            <a href="#" class="text-warning"><i class="fas fa-star"></i></a>
                            <a href="#" class="text-warning"><i class="fas fa-star"></i></a>
                        </div>
                        <ul>
                            <li><b>Colors -</b> <i>Black, yellow, white</i></li>
                            <li><b>Display -</b> <i>LCD</i></li>
                            <li><b>Camera -</b> <i>4K</i></li>
                            <li><b>Memory -</b> <i>64gb</i></li>
                            <li><b>RAM -</b> <i>4gb</i></li>
                        </ul>
                        <div class="mt-3">
                            <button type="button" class="btn btn-primary">Add to cart</button>
                            <button type="button" class="btn btn-success">Buy now</button>
                        </div>
                        <hr>
                        <div class="detail-descr">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                            Odit dolorem tenetur architecto, quisquam velit assumenda 
                            vitae maxime quas officia, debitis sed alias perferendis 
                            animi facilis ipsam dolor illo. Quaerat perferendis dolore 
                            labore officia corrupti repudiandae, officiis vero, saepe 
                            ratione debitis cum quas voluptates, suscipit assumenda 
                            natus? Totam tempora repellendus beatae!
                        </div>
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
                  
                      <div class="media media-response mt-3">
                        <a class="mr-3" href="#">
                          <img src="https://www.shareicon.net/data/512x512/2017/01/06/868320_people_512x512.png" class="mr-3 img-comment" alt="Avatar">
                        </a>
                        <div class="media-body">
                          <h5 class="mt-0">Media heading</h5>
                          Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. 
                          Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. 
                          Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        </div>
                      </div>
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

                        <!-- Product -->
                        <div>
                          <a href="#" class="product product-small">
                            <img src="https://icdn2.digitaltrends.com/image/aem/aem-2020-7-3-dc6bd6650daf4630691cbe11c37b7b42bf0a30e9-500x500.png" alt="Image" class="img-resp">
                            <h5>Smart Phone</h5>
                            Price - <b><i>$200</i></b>
                          </a>
                        </div>
                        <!-- Product end -->
      
                        <!-- Product -->
                        <div>
                          <a href="#" class="product product-small">
                              <img src="https://www.gizmochina.com/wp-content/uploads/2018/11/HiSense-King-Kong-4-500x500.jpg" alt="Image" class="img-resp">
                              <span class="discounted">Discounted</span>
                              <h5>Smart Phone</h5>
                              Price - <b><s><i>$300</i> </s>$180</b>
                          </a>
                        </div>
                        <!-- Product end -->                
      
                        <!-- Product -->
                        <div>
                            <a href="#" class="product product-small">
                                <img src="https://cdn.gsmarena.com/imgroot/news/18/05/aquaris-x2-x2pro/-500/gsmarena_003.jpg" alt="Image" class="img-resp">
                                <h5>Smart Phone</h5>
                                Price - <b><i>$250</i></b>
                            </a>
                        </div>
                        <!-- Product end -->    
      
                        <!-- Product -->
                        <div>
                            <a href="#" class="product product-small">
                                <img src="https://www.eutronix.nl/wp-content/uploads/2019/09/PM90-front-view-500x500.jpg" alt="Image" class="img-resp">
                                <h5>Smart Phone</h5>
                                Price - <b><i>$150</i></b>
                            </a>
                        </div>
                        <!-- Product end -->
      
                        <!-- Product -->
                        <div>
                          <a href="#" class="product product-small">
                              <img src="https://www.worldsim.com/media/catalog/product/cache/2/image/500x500/17f82f742ffe127f42dca9de82fb58b1/h/u/huaweip_1.jpg" alt="Image" class="img-resp">
                              <h5>Smart Phone</h5>
                              Price - <b><i>$200</i></b>
                          </a>
                        </div>
                        <!-- Product end -->
      
                        <!-- Product -->
                        <div>
                          <a href="#" class="product product-small">
                              <img src="https://www.swissphone.com/wp-content/uploads/2019/05/SOS-Mobile-App_EN.jpg" alt="Image" class="img-resp">
                              <h5>Smart Phone</h5>
                              Price - <b><i>$210</i></b>
                          </a>
                        </div>
                        <!-- Product end -->
      
                    </div>
                </div>
                <div class="col-12 text-center mt-3">
                    <button class="btn btn-primary">All Procucts</button>
                </div>
            </div>
        </div>
    </section>
    {{-- Similar products end --}}

@endsection