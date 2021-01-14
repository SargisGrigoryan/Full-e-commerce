@extends('layout')

@section('content')

    {{-- Order --}}
    <section id="order">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>{{ __('orderList.order_list') }}</h2>
                </div>

                <div class="col-12 mt-3">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Holder</th>
                            <th scope="col">{{ __('orderList.products_qty') }}</th>
                            <th scope="col">{{ __('orderList.price') }}</th>
                            <th scope="col">{{ __('orderList.del_price') }}</th>
                            <th scope="col">{{ __('orderList.total_price') }}</th>
                            <th scope="col">{{ __('orderList.date') }}</th>
                            <th scope="col">{{ __('orderList.status') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                            <tr>
                                <th scope="row">{{ $item->id }}</th>
                                <td>{{ $item->card_holder }}</td>
                                <td>{{ $item->products_qty }}</td>
                                <td>${{ $item->products_price }}</td>
                                <td>${{ $item->delivery_price }}</td>
                                <th>${{ $item->products_price + $item->delivery_price }}</th>
                                <td>{{ $item->date }}</td>
                                <td>
                                    @if ($item->status == 0)
                                        <span class="p-2 text-danger">{{ __('orderList.canceled') }}</span>
                                    @elseif($item->status == 1)
                                        <span class="p-2 text-warning">{{ __('orderList.in_proc') }}</span>
                                    @else
                                        <span class="p-2 text-success">{{ __('orderList.ended') }}</span>
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