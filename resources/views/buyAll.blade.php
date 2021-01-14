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
                    <h2>Warning this is a test payment system</h2>
                    <form 
                            role="form" 
                            action="{{ route('stripe.post') }}" 
                            method="post" 
                            class="require-validation"
                            data-cc-on-file="false"
                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                            id="payment-form">
                        @csrf

                        <div class="form-group">
                            <label for="input1">Holder name</label>
                            <input type="text" class="form-control" id="input1" placeholder="John" value="Test" name="card_holder" required>
                        </div>
                        <div class="form-group">
                            <label for="input3">Card number</label>
                            <input autocomplete='off' class='form-control card-number' size='20' type='text' value="4242 4242 4242 4242">
                        </div>
                        <div class="form-group">
                            <label for="input4">CVV</label>
                            <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text' value="123">
                        </div>
                        <div class="form-group">
                            <label for="input4">MM</label>
                            <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text' value="12">
                        </div>
                        <div class="form-group">
                            <label for="input4">YYYY</label>
                            <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text' value="2024">
                        </div>
                        <div class='form-group'>
                            <div class="error"></div>
                        </div>
                        <button type="submit" class="btn btn-success">{{ __('buyAll.order_now') }}</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </section>
    {{-- Cart end --}}

@endsection