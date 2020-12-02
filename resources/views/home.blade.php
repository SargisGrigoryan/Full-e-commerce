@extends('layout')

@section('content')
    <!-- Slider section -->
    <section id="slider">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="https://piplsay.com/wp-content/uploads/2019/09/Smartphones.jpg" class="d-block w-100" alt="Image">
                <div class="carousel-caption d-none d-md-block">
                  <h5>First slide label</h5>
                  <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="https://images.a1.by/medias/sys_master/images/hec/h28/9041334370334.jpg" class="d-block w-100" alt="Image">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Second slide label</h5>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="https://images.a1.by/medias/sys_master/images/hed/h0b/8958068195358.jpg" class="d-block w-100" alt="Image">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Third slide label</h5>
                  <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
    <!-- Slider section end -->

    <!-- Top Products -->
    <section id="top-products">
        <div class="container-fluid">
            <div class="row">
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
            </div>
        </div>
    </section>
    <!-- Top Products end -->

    <!-- All Products -->
    <section id="all-products">
        <div class="container">
            <div class="row">

              <!-- Header -->
              <div class="col-12 text-center">
                <h1>All Products</h1>
              </div>

              <!-- Product -->
              <div class="col-lg-3 col-md-4 col-6">
                    <a href="#" class="product product-common">
                        <img src="https://icdn2.digitaltrends.com/image/aem/aem-2020-7-3-dc6bd6650daf4630691cbe11c37b7b42bf0a30e9-500x500.png" alt="Image" class="img-resp">
                        <h4>Smart Phone</h4>
                        Price - <b><i>$200</i></b>
                    </a>
                </div>
                <!-- Product end -->

              <!-- Product -->
              <div class="col-lg-3 col-md-4 col-6">
                    <a href="#" class="product product-common">
                        <img src="https://www.gizmochina.com/wp-content/uploads/2018/11/HiSense-King-Kong-4-500x500.jpg" alt="Image" class="img-resp">
                        <span class="discounted">Discounted</span>
                        <h4>Smart Phone</h4>
                        Price - <b><s><i>$300</i> </s>$180</b>
                    </a>
                </div>
                <!-- Product end -->                

              <!-- Product -->
              <div class="col-lg-3 col-md-4 col-6">
                  <a href="#" class="product product-common">
                      <img src="https://cdn.gsmarena.com/imgroot/news/18/05/aquaris-x2-x2pro/-500/gsmarena_003.jpg" alt="Image" class="img-resp">
                      <h4>Smart Phone</h4>
                      Price - <b><i>$250</i></b>
                  </a>
              </div>
              <!-- Product end -->    

              <!-- Product -->
              <div class="col-lg-3 col-md-4 col-6">
                  <a href="#" class="product product-common">
                      <img src="https://www.eutronix.nl/wp-content/uploads/2019/09/PM90-front-view-500x500.jpg" alt="Image" class="img-resp">
                      <h4>Smart Phone</h4>
                      Price - <b><i>$150</i></b>
                  </a>
              </div>
              <!-- Product end -->

              <!-- Product -->
              <div class="col-lg-3 col-md-4 col-6">
                <a href="#" class="product product-common">
                    <img src="https://icdn2.digitaltrends.com/image/aem/aem-2020-7-3-dc6bd6650daf4630691cbe11c37b7b42bf0a30e9-500x500.png" alt="Image" class="img-resp">
                    <h4>Smart Phone</h4>
                    Price - <b><i>$200</i></b>
                </a>
              </div>
              <!-- Product end -->

            <!-- Product -->
            <div class="col-lg-3 col-md-4 col-6">
                  <a href="#" class="product product-common">
                      <img src="https://www.gizmochina.com/wp-content/uploads/2018/11/HiSense-King-Kong-4-500x500.jpg" alt="Image" class="img-resp">
                      <span class="discounted">Discounted</span>
                      <h4>Smart Phone</h4>
                      Price - <b><s><i>$300</i> </s>$180</b>
                  </a>
              </div>
              <!-- Product end -->                

            <!-- Product -->
            <div class="col-lg-3 col-md-4 col-6">
                <a href="#" class="product product-common">
                    <img src="https://cdn.gsmarena.com/imgroot/news/18/05/aquaris-x2-x2pro/-500/gsmarena_003.jpg" alt="Image" class="img-resp">
                    <h4>Smart Phone</h4>
                    Price - <b><i>$250</i></b>
                </a>
            </div>
            <!-- Product end -->    

            <!-- Product -->
            <div class="col-lg-3 col-md-4 col-6">
                <a href="#" class="product product-common">
                    <img src="https://www.eutronix.nl/wp-content/uploads/2019/09/PM90-front-view-500x500.jpg" alt="Image" class="img-resp">
                    <h4>Smart Phone</h4>
                    Price - <b><i>$150</i></b>
                </a>
            </div>
            <!-- Product end -->

            <!-- Product -->
            <div class="col-lg-3 col-md-4 col-6">
              <a href="#" class="product product-common">
                  <img src="https://icdn2.digitaltrends.com/image/aem/aem-2020-7-3-dc6bd6650daf4630691cbe11c37b7b42bf0a30e9-500x500.png" alt="Image" class="img-resp">
                  <h4>Smart Phone</h4>
                  Price - <b><i>$200</i></b>
              </a>
            </div>
            <!-- Product end -->

            <!-- Product -->
            <div class="col-lg-3 col-md-4 col-6">
                  <a href="#" class="product product-common">
                      <img src="https://www.gizmochina.com/wp-content/uploads/2018/11/HiSense-King-Kong-4-500x500.jpg" alt="Image" class="img-resp">
                      <span class="discounted">Discounted</span>
                      <h4>Smart Phone</h4>
                      Price - <b><s><i>$300</i> </s>$180</b>
                  </a>
              </div>
              <!-- Product end -->                

            <!-- Product -->
            <div class="col-lg-3 col-md-4 col-6">
                <a href="#" class="product product-common">
                    <img src="https://cdn.gsmarena.com/imgroot/news/18/05/aquaris-x2-x2pro/-500/gsmarena_003.jpg" alt="Image" class="img-resp">
                    <h4>Smart Phone</h4>
                    Price - <b><i>$250</i></b>
                </a>
            </div>
            <!-- Product end -->    

            <!-- Product -->
            <div class="col-lg-3 col-md-4 col-6">
                <a href="#" class="product product-common">
                    <img src="https://www.eutronix.nl/wp-content/uploads/2019/09/PM90-front-view-500x500.jpg" alt="Image" class="img-resp">
                    <h4>Smart Phone</h4>
                    Price - <b><i>$150</i></b>
                </a>
            </div>
            <!-- Product end -->

            <!-- Load more -->
            <div class="col-12 text-center mt-3">
              <button class="btn btn-primary">Load more</button>
            </div>
            <!-- Load more -->
            </div>
        </div>
    </section>
    <!-- All Products end -->
@endsection