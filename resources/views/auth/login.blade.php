@extends('app')
@section('content')
<form action="{{ route('login') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-12 text-center mt-5">
            <h3>Login <a href="{{ route('user') }}" class="btn btn-info">Click to Registration</a></h3>
        </div>
        @if ($message = Session::get('error'))
        <div class="alert alert-info background-danger">
            <strong>{{ $message }}</strong>
        </div>

        @endif
        <div class="offset-md-3 col-md-6 ">
            <div class="form-group form-primary">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('email') }}</label>

                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{Session::get('email') ?? ''}}"    required>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>
            <div class="form-group form-primary">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{Session::get('password') ?? ''}}" autocomplete="current-password"  required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>
            <div class="form-group text-center mt-3">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </div>
    </div>
</form>
@endsection
