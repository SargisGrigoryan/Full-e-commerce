@extends('layout')

@section('content')

    {{-- Categories table section --}}
    <section id="cat-table">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-2">
                    <h1 class="text-center">{{ __('cat.edit_cat') }}</h1>
                </div>
                <div class="col-lg-6 m-auto">
                    <form action="/saveCat" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $cat->id }}">
                        <div class="form-group">
                            <label for="input1">{{ __('cat.cat_name_en') }}</label>
                            <input type="text" class="form-control" id="input1" placeholder="{{ __('cat.cat_name') }}" name="name_en" value="{{ $cat->name_en }}">
                        </div>
                        <div class="form-group">
                            <label for="input2">{{ __('cat.cat_name_ru') }}</label>
                            <input type="text" class="form-control" id="input2" placeholder="{{ __('cat.cat_name') }}" name="name_ru" value="{{ $cat->name_ru }}">
                        </div>
                        <button type="submit" class="btn btn-success">{{ __('cat.save') }}</button>
                  </form>
                </div>
            </div>
        </div>
    </section>
    {{-- Categories table section end --}}

@endsection