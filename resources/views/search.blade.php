@extends('layout')

@section('content')
    <!-- Searched Products -->
    <section id="searched-products">
        <div class="container">
            <div class="row">

                <!-- Header -->
                <div class="col-12 text-center">
                  <h2>{{ __('search.searched') }}</h2><span>{{ __('search.results_found') }} ({{ count($products) }})</span>
                </div>

                @foreach ($products as $item)
                <!-- Product -->
                <div class="col-lg-3 col-md-4 col-6">
                    <a href="/details/{{ $item->id }}" class="product product-common">
                        @if ($item->in_stock != 0)
                          <span class="text-success">{{ __('search.in_stock') }}</span>
                        @else
                          <span class="text-danger">{{ __('search.not_in_stock') }}</span>
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
                        <span class="discounted">{{ __('search.discount') }}</span>
                        {{ __('search.price') }} - <b><s>${{ $item->price }}</s> <i>${{ $total_price }}</i></b>
                        @else
                        {{ __('search.price') }} - <b><i>${{ $item->price }}</i></b>
                        @endif
                    </a>
                </div>
                <!-- Product end -->    
                @endforeach

                <!-- Pagination -->
                <div class="col-12 text-center mt-3">
                  <hr>
                  @if (count($products) == 0)
                    <div class="col-12">
                        <h3>No result is found for - {{ $searched }}</h3>
                    </div>
                    @endif
                  {{ $products->links('vendor.pagination.custom') }}
                </div>
                <!-- Pagination end -->
            </div>
        </div>
    </section>
    <!-- Searched Products end -->
@endsection