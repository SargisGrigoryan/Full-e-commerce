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
                                        <div class="p-1 bg-warning text-white">Blocked</div>
                                    @elseif($item->status == 1)
                                        <div class="p-1 bg-success text-white">Active</div>
                                    @else
                                        <div class="p-1 bg-danger text-white">Removed</div>
                                    @endif
                                </th>
                                <td>
                                    @if ($item->status)
                                    <a href="/cart/buyNow/{{ $item->product_id }}" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Buy Now"><i class="fas fa-shopping-cart"></i></a>
                                    @else
                                    <button disabled  class="btn btn-secondary"><i class="fas fa-shopping-cart"></i></button>
                                    @endif
                                    <a href="/cart/removeFromCart/{{ $item->id }}" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-12 mt-3">
                    <a href="/cart/buyAll" class="btn btn-primary">Buy all (active products)</a>
                </div>
            </div>
        </div>
    </section>
    {{-- Cart end --}}

@endsection