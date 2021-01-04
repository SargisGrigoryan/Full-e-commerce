@extends('layout')

@section('content')

    {{-- Cart --}}
    <section id="cart">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>{{ __('buyNow.order_now') }}</h2>
                </div>

                <div class="col-12 mt-3">
                    <ul>
                        <li><img src="{{ $product->image }}" alt="Image" class="img-order"></li>
                        <?php
                        if(App::getLocale() == 'en'){
                            $name_result = $product->name_en;
                        }elseif (App::getLocale() == 'ru') {
                            $name_result = $product->name_ru;
                        }else{
                            $name_result = $product->name_en;
                        }
                        ?>
                        <li>{{ __('buyNow.name') }} - {{  $name_result }}</li>
                        <li>{{ __('buyNow.qty') }} - {{ $product_qty }}</li>
                        <li>{{ __('buyNow.price') }} - ${{ $product->price * $product_qty }}</li>
                        <li>{{ __('buyNow.disc') }} - %{{ $product->discount }}</li>
                        <li>{{ __('buyNow.del_price') }} - $10</li>
                        <li>{{ __('buyNow.total_price') }} - ${{ ($product->price - ($product->discount * $product->price / 100)) * $product_qty + 10}}</li>
                    </ul>
                </div>

                <div class="col-12 mt-3">
                    <form action="/orderNow" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="qty" value="{{ $product_qty }}">
                        <div class="form-group">
                            <label for="input1">{{ __('buyNow.first_name') }}</label>
                            <input type="text" class="form-control" id="input1" placeholder="John" name="first_name" value="{{ Session::get('first_name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="input2">{{ __('buyNow.last_name') }}</label>
                            <input type="text" class="form-control" id="input2" placeholder="Snow" name="last_name" value="{{ Session::get('last_name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="input3">{{ __('buyNow.cvv') }}</label>
                            <input type="text" class="form-control" id="input3" placeholder="1234-4567-8912-3456-7891" >
                        </div>
                        <div class="form-group">
                            <label for="input4">{{ __('buyNow.secure_code') }}</label>
                            <input type="text" class="form-control" id="input4" placeholder="123" >
                        </div>
                        <button type="submit" class="btn btn-success">{{ __('buyNow.order_now') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    {{-- Cart end --}}

@endsection