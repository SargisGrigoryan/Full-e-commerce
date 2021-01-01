@extends('layout')

@section('content')

    {{-- Register section --}}
    {{-- <section id="categories">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 ml-auto mr-auto">
                    <h2>{{ __('cat.new_cat') }}</h2>
                    <hr>
                    <form action="addCat" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="input1">{{ __('cat.cat_name') }}</label>
                            <input type="text" class="form-control" id="input1" placeholder="{{ __('cat.cat_placeholder') }}" name="name">
                        </div>
                        <button type="submit" class="btn btn-secondary">{{ __('cat.add') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section> --}}
    {{-- Register section end --}}

    {{-- Categories table section --}}
    <section id="cat-table">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-2">
                    <h1 class="text-center">All categories</h1>
                </div>
                <div class="col-12">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#ID</th>
                          <th scope="col">Name</th>
                          <th scope="col">Date</th>
                          <th scope="col">Used</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($cats as $cat)
                            <?php
                            $cat_counter = 0;
                            foreach ($products_cats as $product_cat) {
                                if($cat->id == $product_cat->cat_id){
                                    $cat_counter++;
                                }
                            }
                            ?>
                            <tr>
                                <th scope="row">{{ $cat->id }}</th>
                                <td>{{ $cat->cat_name }}</td>
                                <td>{{ $cat->date }}</td>
                                <td>{{ $cat_counter }}</td>
                                <td>
                                    @if ($cat_counter != 0)
                                        <button class="btn btn-secondary" disabled><i class="fas fa-trash"></i></button>
                                    @else
                                        <a href="/removeCat/{{ $cat->id }}" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove"><i class="fas fa-trash"></i></a>
                                    @endif
                                    <a href="/editCat/{{ $cat->id }}" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fas fa-pen"></i></i></a>
                                </td>
                            </tr>
                          @endforeach
                          <tr>
                            <form action="addCat" method="POST">
                                @csrf
                                <th scope="row">Add new</th>
                                <th>
                                  <div class="form-group">
                                      <input type="text" class="form-control" id="input1" placeholder="{{ __('cat.cat_name') }}" name="name">
                                  </div>
                                </th>
                                <th>...</th>
                                <th>...</th>
                                <th>
                                  <button type="submit" class="btn btn-secondary">{{ __('cat.add') }}</button>
                                </th>
                            </form>
                          </tr>
                      </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="col-12 text-center mt-3">
                    <hr>
                    {{ $cats->links('vendor.pagination.custom') }}
                </div>
                <!-- Pagination end -->
            </div>
        </div>
    </section>
    {{-- Categories table section end --}}

@endsection