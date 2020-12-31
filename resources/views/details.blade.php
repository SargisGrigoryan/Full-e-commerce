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
                        @if ($data->in_stock != 0)
                            <span class="text-success">{{ __('details.in_stock') }}</span>
                        @else
                            <span class="text-danger">{{ __('details.not_in_stock') }}</span>
                        @endif
                        <hr>
                        @if ($data->discount > 0)
                        <?php
                            $total_price = $data->price - ($data->discount * $data->price / 100)
                        ?>
                        <h4><s>${{ $data->price }}</s> ${{ $total_price }} <small class="discount-percent bg-danger text-light">%{{ $data->discount }} {{ __('details.discounted') }}</small></h4>
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
                            <li><b>{{ __('details.colors') }} -</b> <i>{{ $data->colors }}</i></li>
                            <li><b>{{ __('details.display') }} -</b> <i>{{ $data->display }}</i></li>
                            <li><b>{{ __('details.camera') }} -</b> <i>{{ $data->camera }}</i></li>
                            <li><b>{{ __('details.memory') }} -</b> <i>{{ $data->memory }}</i></li>
                            <li><b>{{ __('details.ram') }} -</b> <i>{{ $data->ram }}</i></li>
                        </ul>
                        <div class="mt-3">
                            @if (!session()->has('admin'))
                                @if ($data->in_stock != 0)
                                    <form action="addToCart" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $data->id }}" name="product_id">
                                        <div class="form-group">
                                            <label for="input1">{{ __('details.qty') }}</label>
                                            <input type="number" class="form-control" placeholder="Quantity" name="qty" id="input1" min="{{ $data->in_stock==0?'0':'1' }}" max="{{ $data->in_stock }}" value="{{ $data->in_stock==0?'0':'1' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">{{ __('details.color') }}</label>
                                            <?php
                                                $colors_array = explode(', ', $data->colors);
                                            ?>
                                            <select class="form-control" id="exampleFormControlSelect1" name="color">
                                                @foreach ($colors_array as $color)
                                                    <option value="{{ $color }}">{{ $color }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">{{ __('details.add_to_cart') }}</button>
                                    </form>

                                    <form action="/buyNow" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $data->id }}" name="product_id">
                                        <input type="hidden" id="qty_input" name="qty">
                                        <input type="hidden" id="color_input" name="color">
                                        <button type="submit" class="btn btn-success mt-3">{{ __('details.buy_now') }}</button>
                                    </form>
                                @else
                                    <div class="mb-3">
                                        <button type="button" disabled class="btn btn-secondary">{{ __('details.add_to_cart') }}</button>
                                    </div>
                                    <button type="button" disabled class="btn btn-secondary">{{ __('details.buy_now') }}</button>
                                @endif
                            @else
                                <div class="mt-2">
                                    <a href="/editProduct/{{ $data->id }}" class="btn btn-secondary">{{ __('details.edit') }}</a>
                                </div>
                            @endif
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
                    <h3>{{ __('details.reviews') }} ({{ $reviews_count }})</h3>
                    <hr>
                </div>
                <div class="col-12 mt-3">
                    <form id="comments-form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $data->id }}">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">{{ __('details.leave_comment') }}</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="{{ __('details.text_1') }}" name="comment"></textarea>
                        </div>
                        @if (session()->has('user') || session()->has('admin'))
                            <button type="submit" class="btn btn-primary">{{ __('details.send') }}</button>
                        @else
                            <a href="/login" class="btn btn-primary">{{ __('details.send') }}</a>
                        @endif
                    </form>
                </div>
                <div class="col-12">
                    <div class="row" id="details-comments"></div>
                </div>

                <div class="col-12 text-center mt-2">
                    <button type="button" class="btn btn-primary btn-load-comments">{{ __('details.load_more') }}</button>
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
                    <h3>{{ __('details.similar_products') }}</h3>
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
                                    <span class="discounted">{{ __('details.discount') }}</span>
                                    {{ __('details.price') }} - <b><s>${{ $item->price }}</s> <i>${{ $total_price }}</i></b>
                                @else
                                    {{ __('details.price') }} - <b><i>${{ $item->price }}</i></b>
                                @endif
                            </a>
                        </div>
                        <!-- Product end -->
                        @endforeach

                    </div>
                </div>
                <div class="col-12 text-center mt-3">
                    <a href="/" class="btn btn-primary">{{ __('details.all_products') }}</a>
                </div>
            </div>
        </div>
    </section>
    {{-- Similar products end --}}

@endsection