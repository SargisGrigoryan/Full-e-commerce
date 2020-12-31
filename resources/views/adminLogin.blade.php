@extends('layout')

@section('content')

    {{-- Login ssection --}}
    <section id="user-login">
        <div class="container">
            <div class="row">
                <div class="col-4 ml-auto mr-auto">
                    <h2>{{ __('adminLogin.admin') }}</h2>
                    <hr>
                    <form action="adminLogin" method="POST">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">{{ __('adminLogin.email_address') }}</label>
                          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="example@email.com" name="email" value="{{ Session::get('email') }}">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">{{ __('adminLogin.password') }}</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="********" name="password">
                        </div>
                        <div class="form-group form-check">
                          <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember[]">
                          <label class="form-check-label" for="exampleCheck1">{{ __('adminLogin.remember_me') }}</label>
                        </div>
                        <button type="submit" class="btn btn-secondary">{{ __('adminLogin.login') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    {{-- Login ssection end --}}

@endsection