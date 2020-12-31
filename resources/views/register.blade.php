@extends('layout')

@section('content')

    {{-- Register ssection --}}
    <section id="user-login">
        <div class="container">
            <div class="row">
                <div class="col-4 ml-auto mr-auto">
                    <h2>{{ __('register.new_acc') }}</h2>
                    <hr>
                    <form action="register" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="input1">{{ __('register.first_name') }}</label>
                            <input type="text" class="form-control" id="input1" placeholder="John" name="first_name" value="{{ Session::get('first_name') }}" >
                        </div>
                        <div class="form-group">
                            <label for="input2">{{ __('register.last_name') }}</label>
                            <input type="text" class="form-control" id="input2" placeholder="Snow" name="last_name" value="{{ Session::get('last_name') }}" >
                        </div>
                        <div class="form-group">
                            <label for="File1">{{ __('register.your_picture') }}</label>
                            <input type="file" class="form-control-file" id="File1" name="personal_image" >
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">{{ __('register.email_address') }}</label>
                          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="example@email.com" name="email" value="{{ Session::get('email') }}" >
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">{{ __('register.password') }}</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="********" name="password_1" value="{{ Session::get('password_1') }}" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword2">{{ __('register.confirm_pass') }}</label>
                            <input type="password" class="form-control" id="exampleInputPassword2" placeholder="********" name="password_2" value="{{ Session::get('password_2') }}" >
                        </div>
                        <button type="submit" class="btn btn-secondary">{{ __('register.register') }}</button>
                        <div class="mt-3">
                            {{ __('register.text_1') }} <a href="/login">{{ __('register.login') }}</a> {{ __('register.text_2') }}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    {{-- Register ssection end --}}

@endsection