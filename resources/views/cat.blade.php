@extends('layout')

@section('content')

    {{-- Register ssection --}}
    <section id="add-product">
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
    </section>
    {{-- Register ssection end --}}

@endsection