@extends('layout')

@section('content')

    {{-- Cart --}}
    <section id="cart">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-3">
                    <h2>{{ __('blockedProducts.blocked_products') }}</h2>
                </div>
                <div class="col-12">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">{{ __('blockedProducts.image') }}</th>
                            <th scope="col">{{ __('blockedProducts.name') }}</th>
                            <th scope="col">{{ __('blockedProducts.cat') }}</th>
                            <th scope="col">{{ __('blockedProducts.price') }}</th>
                            <th scope="col">{{ __('blockedProducts.disc') }}</th>
                            <th scope="col">{{ __('blockedProducts.total') }}</th>
                            <th scope="col">{{ __('blockedProducts.slider') }}</th>
                            <th scope="col">{{ __('blockedProducts.top') }}</th>
                            <th scope="col">{{ __('blockedProducts.in_stock') }}</th>
                            <th scope="col">{{ __('blockedProducts.date') }}</th>
                            <th scope="col">{{ __('blockedProducts.action') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($products_blocked as $product)
                            <tr>
                                <th scope="row">{{ $product->id }}</th>
                                <td><a href="/editProduct/{{ $product->id }}"><img src="{{ $product->image }}" alt="Image" class="img-products"></a></td>
                                <td>
                                    @if (App::getLocale() == 'en')
                                        {{ $product->name_en }}
                                    @elseif(App::getLocale() == 'ru')
                                        {{ $product->name_ru }}
                                    @else
                                        {{ $product->name_en }}
                                    @endif
                                </td>
                                <td>{{ $product->cat_name }}</td>
                                <td>${{ $product->price }}</td>
                                <td>%{{ $product->discount }}</td>
                                <td>${{ $product->price - ($product->discount * $product->price / 100) }}</td>
                                <td>
                                    @if ($product->slider == 0)
                                        <span class="p-2 bg-danger text-white">{{ __('blockedProducts.off') }}</span>
                                    @else
                                        <span class="p-2 bg-success text-white">{{ __('blockedProducts.on') }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($product->top == 0)
                                        <span class="p-2 bg-danger text-white">{{ __('blockedProducts.off') }}</span>
                                    @else
                                        <span class="p-2 bg-success text-white">{{ __('blockedProducts.on') }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($product->in_stock == 0)
                                        <span class="p-2 bg-danger text-white">{{ __('blockedProducts.not') }}</span>
                                    @else
                                        <span class="p-2 bg-success text-white">{{ __('blockedProducts.in') }}</span>
                                    @endif
                                </td>
                                <td>{{ $product->date }}</td>
                                <th>
                                  <a href="/recoverProductFromBlocked/{{ $product->id }}" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Recover Product"><i class="fas fa-redo"></i></a>
                                  <a href="/removeProductFromBlocked/{{ $product->id }}" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove Product"><i class="fas fa-trash"></i></a>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-12 text-center">
                    @if ($products_blocked_qty == 0)
                    <h4>{{ __('blockedProducts.no_result') }}</h4>
                    @endif
                    {{-- Paginate Blocked products --}}
                    {{ $products_blocked->links('vendor.pagination.custom') }}
                    {{-- Paginate Blocked products end --}}
                </div>
            </div>
        </div>
    </section>
    {{-- Cart end --}}

@endsection