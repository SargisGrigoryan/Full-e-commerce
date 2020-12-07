@extends('layout')

@section('content')

    {{-- Register ssection --}}
    <section id="add-product">
        <div class="container">
            <div class="row">
                <div class="col-4 ml-auto mr-auto">
                    <h2>Add new category</h2>
                    <hr>
                    <form action="addCat" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="input1">Name</label>
                            <input type="text" class="form-control" id="input1" placeholder="Category Name" name="name">
                        </div>
                        <button type="submit" class="btn btn-secondary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    {{-- Register ssection end --}}

@endsection