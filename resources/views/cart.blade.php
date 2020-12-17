@extends('layout')

@section('content')

    {{-- Cart --}}
    <section id="cart">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Your cart list</h2>
                </div>

                <div class="col-12 mt-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Color</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
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
                                    <s>${{ $item->price }}</s> ${{ $total_price }} <small class="discount-percent bg-danger text-light">%{{ $item->discount }} Discounted</small>
                                    @else
                                    ${{ $item->price }}
                                    @endif
                                </td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->color }}</td>
                                <th>
                                    @if ($item->status == 0)
                                        <span class="p-2 bg-warning text-white">Blocked</span>
                                    @elseif($item->status == 1)
                                        <span class="p-2 bg-success text-white">Active</span>
                                    @else
                                        <span class="p-2 bg-danger text-white">Removed</span>
                                    @endif
                                </th>
                                <td>
                                    @if ($item->status == 1)
                                    <form action="/buyNow" method="POST" class="d-inline-block">
                                        @csrf
                                        <input type="hidden" value="{{ $item->product_id }}" name="product_id">
                                        <input type="hidden" value="{{ $item->qty }}" name="qty">
                                        <input type="hidden" value="{{ $item->color }}" name="color">
                                        <button type="submit" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Buy this one"><i class="fas fa-shopping-cart"></i></button>
                                    </form>
                                    @else
                                    <button type="button" disabled class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Buy this one"><i class="fas fa-shopping-cart"></i></button>
                                    @endif
                                    <a href="/cart/removeFromCart/{{ $item->id }}" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-12">
                    @if (count($userCart) == 0)
                    <h4>No result is found</h4>
                    @endif
                    {{-- Paginate cart products --}}
                    {{ $userCart->links('vendor.pagination.custom') }}
                    {{-- Paginate cart products end --}}
                </div>

                @if (count($userCart) > 0)
                <div class="col-12 mt-3">
                    <a href="/buyAll" class="btn btn-primary">Buy all (active products)</a>
                </div>
                @endif

            </div>
        </div>
    </section>
    {{-- Cart end --}}

@endsection