@extends('layout')

@section('content')

    {{-- Cart --}}
    <section id="cart">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Your cart list</h2>
                </div>
                <div class="col-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="active-tab" data-bs-toggle="tab" href="#active" role="tab" aria-controls="home" aria-selected="true">Active({{ $products_active_qty }})</a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link" id="blocked-tab" data-bs-toggle="tab" href="#blocked" role="tab" aria-controls="profile" aria-selected="false">Blocked({{ $products_blocked_qty }})</a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link" id="removed-tab" data-bs-toggle="tab" href="#removed" role="tab" aria-controls="contact" aria-selected="false">Removed({{ $products_removed_qty }})</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        {{-- Active products --}}
                        <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
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
                                    @foreach ($products_active as $product)
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
                                          <a href="/blockProduct/{{ $product->id }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Block Product"><i class="fas fa-lock"></i></a>
                                          <a href="/removeProduct/{{ $product->id }}" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove Product"><i class="fas fa-trash"></i></a>
                                        </th>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- Paginate active products --}}
                            {{ $products_active->links('vendor.pagination.custom') }}
                            {{-- Paginate active products end --}}
                        </div>
                        {{-- Active products end --}}

                        {{-- Blocked products --}}
                        <div class="tab-pane fade" id="blocked" role="tabpanel" aria-labelledby="blocked-tab">
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
                                    @foreach ($products_blocked as $product)
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
                                          <a href="/recoverProduct/{{ $product->id }}" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Recover Product"><i class="fas fa-redo"></i></a>
                                          <a href="/removeProduct/{{ $product->id }}" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove Product"><i class="fas fa-trash"></i></a>
                                        </th>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- Paginate Blocked products --}}
                            {{ $products_blocked->links('vendor.pagination.custom') }}
                            {{-- Paginate Blocked products end --}}
                        </div>
                        {{-- Blocked products end --}}

                        {{-- Removed products --}}
                        <div class="tab-pane fade" id="removed" role="tabpanel" aria-labelledby="removed-tab">
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
                                            <a href="/blockProduct/{{ $product->id }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Block Product"><i class="fas fa-lock"></i></a>
                                            <a href="/recoverProduct/{{ $product->id }}" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Recover Product"><i class="fas fa-redo"></i></a>
                                        </th>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- Paginate Blocked products --}}
                            {{ $products_removed->links('vendor.pagination.custom') }}
                            {{-- Paginate Blocked products end --}}
                        </div>
                        {{-- Removed products end --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Cart end --}}

@endsection