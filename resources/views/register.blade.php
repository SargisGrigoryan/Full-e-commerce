@extends('layout')

@section('content')

    {{-- Register ssection --}}
    <section id="user-login">
        <div class="container">
            <div class="row">
                <div class="col-4 ml-auto mr-auto">
                    <h2>Make new account</h2>
                    <hr>
                    <form action="register" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="input1">First name</label>
                            <input type="text" class="form-control" id="input1" placeholder="John" name="first_name" value="{{ Session::get('first_name') }}" >
                        </div>
                        <div class="form-group">
                            <label for="input2">Last name</label>
                            <input type="text" class="form-control" id="input2" placeholder="Snow" name="last_name" value="{{ Session::get('last_name') }}" >
                        </div>
                        <div class="form-group">
                            <label for="File1">Your image</label>
                            <input type="file" class="form-control-file" id="File1" name="personal_image" >
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="example@email.com" name="email" value="{{ Session::get('email') }}" >
                          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="********" name="password_1" value="{{ Session::get('password_1') }}" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword2">Confirm Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword2" placeholder="********" name="password_2" value="{{ Session::get('password_2') }}" >
                        </div>
                        <button type="submit" class="btn btn-secondary">Register</button>
                        <div class="mt-3">
                            If you have an account you can <a href="/login">login now</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    {{-- Register ssection end --}}

@endsection