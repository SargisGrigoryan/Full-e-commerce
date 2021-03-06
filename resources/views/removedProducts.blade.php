@extends('layout')

@section('content')

    {{-- Cart --}}
    <section id="cart">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-3">
                    <h2>{{ __('removedProducts.removed_products') }}</h2>
                </div>
                <div class="col-12">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">{{ __('removedProducts.image') }}</th>
                            <th scope="col">{{ __('removedProducts.name') }}</th>
                            <th scope="col">{{ __('removedProducts.cat') }}</th>
                            <th scope="col">{{ __('removedProducts.price') }}</th>
                            <th scope="col">{{ __('removedProducts.disc') }}</th>
                            <th scope="col">{{ __('removedProducts.total') }}</th>
                            <th scope="col">{{ __('removedProducts.slider') }}</th>
                            <th scope="col">{{ __('removedProducts.top') }}</th>
                            <th scope="col">{{ __('removedProducts.in_stock') }}</th>
                            <th scope="col">{{ __('removedProducts.date') }}</th>
                            <th scope="col">{{ __('removedProducts.action') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($products_removed as $product)
                            <tr>
                                <th scope="row">{{ $product->id }}</th>
                                <td><img src="{{ $product->image }}" alt="Image" class="img-products"></td>
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
                                        <span class="p-2 bg-danger text-white">{{ __('removedProducts.off') }}</span>
                                    @else
                                        <span class="p-2 bg-success text-white">{{ __('removedProducts.on') }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($product->top == 0)
                                        <span class="p-2 bg-danger text-white">{{ __('removedProducts.off') }}</span>
                                    @else
                                        <span class="p-2 bg-success text-white">{{ __('removedProducts.on') }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($product->in_stock == 0)
                                        <span class="p-2 bg-danger text-white">{{ __('removedProducts.not') }}</span>
                                    @else
                                        <span class="p-2 bg-success text-white">{{ __('removedProducts.in') }}</span>
                                    @endif
                                </td>
                                <td>{{ $product->date }}</td>
                                <th>
                                    <a href="/blockProductFromTrash/{{ $product->id }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Block Product"><i class="fas fa-lock"></i></a>
                                    <a href="/recoverProductFromTrash/{{ $product->id }}" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Recover Product"><i class="fas fa-redo"></i></a>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-12 text-center">
                    @if ($products_removed_qty == 0)
                    <h4>{{ __('removedProducts.no_result') }}</h4>
                    @endif
                    {{-- Paginate Blocked products --}}
                    {{ $products_removed->links('vendor.pagination.custom') }}
                    {{-- Paginate Blocked products end --}}
                </div>
            </div>
        </div>
    </section>
    {{-- Cart end --}}

@endsection