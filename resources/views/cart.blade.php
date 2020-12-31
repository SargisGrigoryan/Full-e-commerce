@extends('layout')

@section('content')

    {{-- Cart --}}
    <section id="cart">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>{{ __('cart.your_cart') }}</h2>
                </div>

                <div class="col-12 mt-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('cart.image') }}</th>
                                <th scope="col">{{ __('cart.name') }}</th>
                                <th scope="col">{{ __('cart.price') }}</th>
                                <th scope="col">{{ __('cart.qty') }}</th>
                                <th scope="col">{{ __('cart.color') }}</th>
                                <th scope="col">{{ __('cart.status') }}</th>
                                <th scope="col">{{ __('cart.in_stock') }}</th>
                                <th scope="col">{{ __('cart.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userCart as $item)
                            <tr>
                                <th scope="row">
                                    <div class="cart-image">
                                        <a href="/details/{{ $item->product_id }}">
                                            <img src="{{ $item->image }}" alt="Image" class="img-resp">
                                        </a>
                                    </div>
                                </th>
                                <td>{{ $item->name }}</td>
                                <td>
                                    @if ($item->discount > 0)
                                    <?php
                                        $total_price = $item->price - ($item->discount * $item->price / 100)
                                    ?>
                                    <s>${{ $item->price }}</s> ${{ $total_price }}
                                    @else
                                    ${{ $item->price }}
                                    @endif
                                </td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->color }}</td>
                                <th>
                                    @if ($item->status == 0)
                                        <span class="p-2 text-warning">{{ __('cart.blocked') }}</span>
                                    @elseif($item->status == 1)
                                        <span class="p-2text-success">{{ __('cart.active') }}</span>
                                    @else
                                        <span class="p-2 text-danger">{{ __('cart.removed') }}</span>
                                    @endif
                                </th>
                                <th>
                                    @if ($item->in_stock == 0)
                                        <span class="p-2 text-danger">{{ __('cart.not_in_stock') }}</span>
                                    @else
                                        <span class="p-2 text-success">{{ __('cart.in_stock') }}</span>
                                    @endif
                                </th>
                                <td>
                                    @if ($item->status == 1 && $item->in_stock != 0)
                                    <form action="/buyNow" method="POST" class="d-inline-block">
                                        @csrf
                                        <input type="hidden" value="{{ $item->product_id }}" name="product_id">
                                        <input type="hidden" value="{{ $item->qty }}" name="qty">
                                        <input type="hidden" value="{{ $item->color }}" name="color">
                                        <button type="submit" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('cart.buy_this') }}"><i class="fas fa-shopping-cart"></i></button>
                                    </form>
                                    @else
                                    <button type="button" disabled class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('cart.buy_this') }}"><i class="fas fa-shopping-cart"></i></button>
                                    @endif
                                    <a href="/cart/removeFromCart/{{ $item->id }}" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('cart.remove') }}"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-12">
                    @if (count($userCart) == 0)
                    <h4>{{ __('cart.no_result') }}</h4>
                    @endif
                    {{-- Paginate cart products --}}
                    {{ $userCart->links('vendor.pagination.custom') }}
                    {{-- Paginate cart products end --}}
                </div>

                @if (count($userCart) > 0)
                <div class="col-12 mt-3">
                    <a href="/buyAll" class="btn btn-primary">{{ __('cart.buy_all') }}</a>
                </div>
                @endif

            </div>
        </div>
    </section>
    {{-- Cart end --}}

@endsection