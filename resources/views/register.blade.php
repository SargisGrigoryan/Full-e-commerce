@extends('layout')

@section('content')

    {{-- Register ssection --}}
    <section id="user-login">
        <div class="container">
            <div class="row">
                <div class="col-4 ml-auto mr-auto">
                    <h2>Make new account</h2>
                    <hr>
                    <form>
                        <div class="form-group">
                            <label for="input1">First name</label>
                            <input type="text" class="form-control" id="input1" placeholder="John">
                        </div>
                        <div class="form-group">
                            <label for="input1">Last name</label>
                            <input type="text" class="form-control" id="input1" placeholder="Snow">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="example@email.com">
                          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="********">
                        </div>
                        <button type="submit" class="btn btn-secondary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    {{-- Register ssection end --}}

@endsection