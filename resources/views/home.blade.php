@extends('layout')

@section('content')
    <!-- Slider section -->
    <section id="slider">
      <div class="container-fluid p-0">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">

            <div class="carousel-inner">
              <?php
                $counter = 1;  
              ?>
              @foreach ($slider_products as $item)
              <div class="carousel-item {{ $counter==1?'active':'' }}">
                <a href="/details/{{ $item->id }}">
                  <img src="{{ $item->slider_image }}" class="d-block w-100" alt="Image">
                  <div class="carousel-caption d-none d-md-block">
                    <h5>
                      @if (App::getLocale() == 'en')
                          {{ $item->name_en }}
                      @elseif(App::getLocale() == 'ru')
                          {{ $item->name_ru }}
                      @else
                          {{ $item->name_en }}
                      @endif  
                    </h5>
                    <p>Lorem, ipsum dolor...</p>
                  </div>
                </a>
              </div>
              <?php
                $counter++;  
              ?>
              @endforeach
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
      </div>
    </section>
    <!-- Slider section end -->

    <!-- Top Products -->
    <section id="top-products">
        <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="owl-carousel">

                  @foreach ($top_products as $item)
                  <!-- Product -->
                  <div>
                    <a href="/details/{{ $item->id }}" class="product product-small">
                      <img src="{{ $item->image }}" alt="Image" class="img-resp">
                      <h5>
                        @if (App::getLocale() == 'en')
                            {{ $item->name_en }}
                        @elseif(App::getLocale() == 'ru')
                            {{ $item->name_ru }}
                        @else
                            {{ $item->name_en }}
                        @endif  
                      </h5>
                      @if ($item->discount > 0)
                        <?php
                          $total_price = $item->price - ($item->discount * $item->price / 100)
                        ?>
                        <span class="discounted">{{ __('home.discount') }}</span>
                        {{ __('home.price') }} - <b><s>${{ $item->price }}</s> <i>${{ $total_price }}</i></b>
                      @else
                        {{ __('home.price') }} - <b><i>${{ $item->price }}</i></b>
                      @endif
                    </a>
                  </div>
                  <!-- Product end -->
                  @endforeach

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
                  <h1>{{ __('home.all_products') }}</h1>
                </div>

                @foreach ($all_products as $item)
                <!-- Product -->
                <div class="col-lg-3 col-md-4 col-6">
                    <a href="/details/{{ $item->id }}" class="product product-common">
                        @if ($item->in_stock != 0)
                          <span class="text-success">{{ __('home.in_stock') }}</span>
                        @else
                          <span class="text-danger">{{ __('home.not_in_stock') }}</span>
                        @endif
                        <img src="{{ $item->image }}" alt="Image" class="img-resp">
                        <h4>
                          @if (App::getLocale() == 'en')
                              {{ $item->name_en }}
                          @elseif(App::getLocale() == 'ru')
                              {{ $item->name_ru }}
                          @else
                              {{ $item->name_en }}
                          @endif  
                        </h4>
                        @if ($item->discount > 0)
                        <?php
                          $total_price = $item->price - ($item->discount * $item->price / 100)
                        ?>
                        <span class="discounted">{{ __('home.discount') }}</span>
                        {{ __('home.price') }} - <b><s>${{ $item->price }}</s> <i>${{ $total_price }}</i></b>
                        @else
                        {{ __('home.price') }} - <b><i>${{ $item->price }}</i></b>
                        @endif
                    </a>
                </div>
                <!-- Product end -->    
                @endforeach

                <!-- Pagination -->
                <div class="col-12 text-center mt-3">
                  <hr>
                  {{ $all_products->links('vendor.pagination.custom') }}
                </div>
                <!-- Pagination end -->
            </div>
        </div>
    </section>
    <!-- All Products end -->
@endsection