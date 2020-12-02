@extends('layout')

@section('content')

    {{-- Login ssection --}}
    <section id="user-login">
        <div class="container">
            <div class="row">
                <div class="col-4 ml-auto mr-auto">
                    <h2>Verify your email</h2>
                    <hr>
                    <form>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Enter your code here</label>
                          <input type="text" class="form-control" id="exampleInputEmail1">
                        </div>
                        <button type="submit" class="btn btn-secondary">Next</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    {{-- Login ssection end --}}

@endsection