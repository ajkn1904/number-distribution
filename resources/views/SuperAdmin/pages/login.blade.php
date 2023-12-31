@extends('sitelayouts.layouts.single_col')

@section('contents')
<div class="col-lg-5">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class=" card-header">
            <h3 class="text-center font-weight-light my-4">Login</h3>
        </div>
        <div class="card-body">

            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>

                @if(Session::has('error'))
                <div class="alert alert-danger">

                    {{Session::get('error')}}

                </div>
                @endif

            </div>


            <form method="post" action="{{ url('/user-login') }}">
                @csrf
                <div class="form-floating mb-3">
                    <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com"
                        name="email" />
                    <label for="inputEmail">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" id="inputPassword" type="password" placeholder="Password"
                        name="password" />
                    <label for="inputPassword">Password</label>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                    <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                </div>
                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                    <a class="small" href="password.html">Forgot Password?</a>
                    <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                </div>
            </form>
        </div>
        <div class="card-footer text-center py-3">
            <div class="small"><a href="{{url('/student-register')}}">Need an account? Sign up!</a></div>
        </div>
    </div>
</div>

@endsection