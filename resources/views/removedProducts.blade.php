@extends('layout')

@section('content')

    {{-- Cart --}}
    <section id="cart">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-3">
                    <h2>Removed products</h2>
                </div>
                <div class="col-12">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Price</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Total</th>
                            <th scope="col">Slider</th>
                            <th scope="col">Top</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($products_removed as $product)
                            <tr>
                                <th scope="row">{{ $product->id }}</th>
                                <td><img src="{{ $product->image }}" alt="Image" class="img-products"></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->cat_name }}</td>
                                <td>${{ $product->price }}</td>
                                <td>%{{ $product->discount }}</td>
                                <td>${{ $product->price - ($product->discount * $product->price / 100) }}</td>
                                <td>
                                    @if ($product->slider == 0)
                                        <span class="p-2 bg-danger text-white">Off</span>
                                    @else
                                        <span class="p-2 bg-success text-white">On</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($product->top == 0)
                                        <span class="p-2 bg-danger text-white">Off</span>
                                    @else
                                        <span class="p-2 bg-success text-white">On</span>
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
                    <h4>No result is found</h4>
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