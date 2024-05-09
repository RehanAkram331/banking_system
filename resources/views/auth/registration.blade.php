@extends('app')
@section('content')
<form action="{{ route('user-store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-12 text-center mt-5">
            <h3>User Registration <a href="{{ route('show-login') }}" class="btn btn-info">Click to Login</a></h3>
        </div>
        @if ($message = Session::get('error'))
        <div class="alert alert-info background-danger">
            <strong>{{ $message }}</strong>
        </div>
        @endif
        <div class="offset-md-3 col-md-6 ">
            <div class="form-group">
                <div class="form-label">Name</div>
                <input type="text" class="form-control name" name="name" autocomplete="off">
            </div>
            <div class="form-group">
                <div class="form-label">Account Type</div>
                <select class="form-control account_type" name="account_type" autocomplete="off">
                    <option value="Individual">Individual</option>
                    <option value="Business">Business</option>
                </select>
            </div>
            <div class="form-group">
                <div class="form-label">Email</div>
                <input type="email" class="form-control email" name="email" autocomplete="off">
            </div>
            <div class="form-group">
                <div class="form-label">Password</div>
                <input type="password" class="form-control password" name="password" autocomplete="off">
            </div>
            <div class="form-group text-center mt-3">
                <button type="submit" class="btn btn-primary">Registration</button>
            </div>
        </div>
    </div>
</form>
@endsection
