@extends('layout')

@section('content')
    <!-- Searched Products -->
    <section id="searched-products">
        <div class="container">
            <div class="row">

                <!-- Header -->
                <div class="col-12 text-center">
                  <h2>Searched Products</h2><span>Results found ({{ count($products) }})</span>
                </div>

                @foreach ($products as $item)
                <!-- Product -->
                <div class="col-lg-3 col-md-4 col-6">
                    <a href="/details/{{ $item->id }}" class="product product-common">
                        @if ($item->in_stock != 0)
                          <span class="text-success">In stock</span>
                        @else
                          <span class="text-danger">Not in stock</span>
                        @endif
                        <img src="{{ $item->image }}" alt="Image" class="img-resp">
                        <h4>{{ $item->name }}</h4>
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