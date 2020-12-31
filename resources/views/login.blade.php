@extends('layout')

@section('content')

    {{-- Login ssection --}}
    <section id="user-login">
        <div class="container">
            <div class="row">
                <div class="col-4 ml-auto mr-auto">
                    <h2>{{ __('login.login_header') }}</h2>
                    <hr>
                    <form action="login" method="POST">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">{{ __('login.email_address') }}</label>
                          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="example@email.com" name="email" value="{{ Session::get('email') }}">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">{{ __('login.password') }}</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="********" name="password">
                        </div>
                        <div class="form-group form-check">
                          <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember[]">
                          <label class="form-check-label" for="exampleCheck1">{{ __('login.remember_me') }}</label>
                        </div>
                        <button type="submit" class="btn btn-secondary">{{ __('login.login') }}</button>
                        <div class="mt-3">
                          <a href="/register">{{ __('login.make_new') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    {{-- Login ssection end --}}

@endsection