@extends('layout')

@section('content')

    {{-- Categories table section --}}
    <section id="cat-table">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-2">
                    <h1 class="text-center">Edit category</h1>
                </div>
                <div class="col-lg-6 m-auto">
                    <form action="/saveCat" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $cat->id }}">
                        <div class="form-group">
                            <input type="text" class="form-control" id="input1" placeholder="{{ __('cat.cat_name') }}" name="name" value="{{ $cat->cat_name }}">
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    {{-- Categories table section end --}}

@endsection