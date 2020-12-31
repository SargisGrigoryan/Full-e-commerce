@extends('layout')

@section('content')

    {{-- Login ssection --}}
    <section id="user-profile">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-3">
                    <img src="{{ $userDatas['personal_image'] }}" alt="Image" class="img-resp">
                    <form action="updateUserImage" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" class="form-control-file mt-2" id="File1" name="personal_image" >
                        <button type="submit" class="btn btn-secondary mt-2">{{ __('my_profile.save') }}</button>
                    </form>
                </div>
                <div class="col-lg-8">
                    <h4>{{ $userDatas['first_name'] }} {{ $userDatas['last_name'] }}</h4>
                    <p>{{ $userDatas['email'] }}</p>
                    <hr>
                    <form action="updateUserData" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="input1">{{ __('my_profile.first_name') }}</label>
                            <input type="text" class="form-control" id="input1" placeholder="John" name="first_name" value="{{ $userDatas['first_name'] }}" >
                        </div>
                        <div class="form-group">
                            <label for="input2">{{ __('my_profile.last_name') }}</label>
                            <input type="text" class="form-control" id="input2" placeholder="Snow" name="last_name" value="{{ $userDatas['last_name'] }}" >
                        </div>
                        <button type="submit" class="btn btn-secondary">{{ __('my_profile.save') }}</button>
                    </form>
                </div>
                <div class="col-lg-6 mt-4">
                    <hr>
                    <h3>{{ __('my_profile.change_pass') }}</h3>
                    <form action="updateUserPass" method="POST">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputPassword1">{{ __('my_profile.current_pass') }}</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="********" name="password_1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword2">{{ __('my_profile.new_password') }}</label>
                            <input type="password" class="form-control" id="exampleInputPassword2" placeholder="********" name="password_2">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword3">{{ __('my_profile.confirm_new_pass') }}</label>
                            <input type="password" class="form-control" id="exampleInputPassword3" placeholder="********" name="password_3">
                        </div>
                        <button type="submit" class="btn btn-secondary">{{ __('my_profile.save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    {{-- Login ssection end --}}

@endsection