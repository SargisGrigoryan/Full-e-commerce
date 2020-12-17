@extends('layout')

@section('content')

    {{-- Order --}}
    <section id="order">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Your order list</h2>
                </div>

                <div class="col-12 mt-3">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">First name</th>
                            <th scope="col">Last name</th>
                            <th scope="col">Products qty.</th>
                            <th scope="col">Products price</th>
                            <th scope="col">Del. price</th>
                            <th scope="col">Total price</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                            <tr>
                                <th scope="row">{{ $item->id }}</th>
                                <td>{{ $item->first_name }}</td>
                                <td>{{ $item->last_name }}</td>
                                <td>{{ $item->products_qty }}</td>
                                <td>${{ $item->products_price }}</td>
                                <td>${{ $item->delivery_price }}</td>
                                <th>${{ $item->products_price + $item->delivery_price }}</th>
                                <td>{{ $item->date }}</td>
                                <td>
                                    @if ($item->status == 0)
                                        <span class="p-2 bg-danger text-white">Canceled</span>
                                    @elseif($item->status == 1)
                                        <span class="p-2 bg-warning text-white">In process</span>
                                    @else
                                        <span class="p-2 bg-success text-white">Ended</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-12">
                    @if (count($orders) == 0)
                    <h4>No result is found</h4>
                    @endif
                    {{-- Paginate cart products --}}
                    {{ $orders->links('vendor.pagination.custom') }}
                    {{-- Paginate cart products end --}}
                </div>
            </div>
        </div>
    </section>
    {{-- Order end --}}

@endsection