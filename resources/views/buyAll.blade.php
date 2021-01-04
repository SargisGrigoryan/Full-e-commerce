@extends('layout')

@section('content')

    {{-- Cart --}}
    <section id="cart">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>{{ __('buyAll.order_now') }}</h2>
                </div>

                <div class="col-12 mt-3">
                    <?php

                    $product_qty = 0;
                    $delivery_price = 15;
                    $products_price = 0;
                    $discounted_prices = 0;
                    
                    foreach ($cart as $item) {
                        $product_qty += $item->qty;
                        $products_price += ($item->price - ($item->discount * $item->price / 100)) * $item->qty;
                    }
                        
                    ?>
                    <ul>
                        <li>{{ __('buyAll.products_qty') }} - {{ $product_qty }}</li>
                        <li>{{ __('buyAll.del_price') }} - ${{ $delivery_price }}</li>
                        <li>{{ __('buyAll.price') }} - ${{ $products_price }} ({{ __('buyAll.text_1') }})</li>
                        <li>{{ __('buyAll.total_price') }} = ${{ $products_price + $delivery_price }}</li>
                    </ul>
                </div>

                <div class="col-12 mt-3">
                    <form action="/orderAll" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="input1">{{ __('buyAll.first_name') }}</label>
                            <input type="text" class="form-control" id="input1" placeholder="John" name="first_name" value="{{ Session::get('first_name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="input2">{{ __('buyAll.last_name') }}</label>
                            <input type="text" class="form-control" id="input2" placeholder="Snow" name="last_name" value="{{ Session::get('last_name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="input3">{{ __('buyAll.cvv') }}</label>
                            <input type="text" class="form-control" id="input3" placeholder="1234-4567-8912-3456-7891" >
                        </div>
                        <div class="form-group">
                            <label for="input4">{{ __('buyAll.secure_code') }}</label>
                            <input type="text" class="form-control" id="input4" placeholder="123" >
                        </div>
                        <button type="submit" class="btn btn-success">{{ __('buyAll.order_now') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    {{-- Cart end --}}

@endsection