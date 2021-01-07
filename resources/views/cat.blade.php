@extends('layout')

@section('content')
    {{-- Categories table section --}}
    <section id="cat-table">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-2">
                    <h1 class="text-center">{{ __('cat.all_cats') }}</h1>
                </div>
                <div class="col-12">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#ID</th>
                          <th scope="col">{{ __('cat.name') }}</th>
                          <th scope="col">{{ __('cat.date') }}</th>
                          <th scope="col">{{ __('cat.used') }}</th>
                          <th scope="col">{{ __('cat.action') }}</th>
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
                                <td>
                                    @if (App::getLocale() == 'en')
                                        {{ $cat->name_en }}
                                    @elseif(App::getLocale() == 'ru')
                                        {{ $cat->name_ru }}
                                    @else
                                        {{ $cat->name_en }}
                                    @endif
                                </td>
                                <td>{{ $cat->date }}</td>
                                <td>{{ $cat_counter }}</td>
                                <td>
                                    @if ($cat_counter != 0)
                                        <button class="btn btn-secondary" disabled><i class="fas fa-trash"></i></button>
                                    @else
                                        <a href="/removeCat/{{ $cat->id }}" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('cat.remove') }}"><i class="fas fa-trash"></i></a>
                                    @endif
                                    <a href="/editCat/{{ $cat->id }}" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('cat.edit') }}"><i class="fas fa-pen"></i></i></a>
                                </td>
                            </tr>
                          @endforeach
                          <tr>
                            <form action="addCat" method="POST">
                                @csrf
                                <th scope="row">{{ __('cat.new') }}</th>
                                <th>
                                  <div class="form-group">
                                      <input type="text" class="form-control" id="input1" placeholder="{{ __('cat.cat_name_en') }}" name="name_en">
                                  </div>
                                </th>
                                <th>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="input2" placeholder="{{ __('cat.cat_name_ru') }}" name="name_ru">
                                    </div>
                                </th>
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