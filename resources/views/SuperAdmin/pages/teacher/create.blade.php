@extends('sitelayouts.layouts.two_col')
@section('main-contents')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tables</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a @if(Session::has('user_role') && (Session::get('user_role')=='SuperAdmin' ))
                href="{{url('/teacher/all_teachers')}}" @elseif(Session::has('user_role') &&
                (Session::get('user_role')=='Admin' )) href="{{url('/teacher/all-department-teachers')}}" @endif>All</a>
        </li>
        <li class="breadcrumb-item active">Create Teacher</li>
    </ol>

    <h1>Create new Teacher</h1>

    <div class="row">
        <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>

        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Teacher Account!</h1>

                <!-- showing success & error msg from Session to user-->
                @if(Session::has('success'))
                <div class="alert alert-success">

                    {{Session::get('success')}}

                </div>
                @endif


                @if(Session::has('error'))
                <div class="alert alert-danger">

                    {{Session::get('error')}}

                </div>
                @endif


            </div>
            <form class="user" method="post" @if(Session::has('user_role') && (Session::get('user_role')=='SuperAdmin'
                ))action="{{ url('/teacher/creation') }} " @elseif(Session::has('user_role') &&
                (Session::get('user_role')=='Admin' ))action="{{ url('/teacher/department-creation') }} " @endif>
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user" name="first_name"
                            id="exampleFirstName" placeholder="First Name">
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" name="last_name" id="exampleLastName"
                            placeholder="Last Name">
                    </div>
                </div>
                <div class="form-group row my-2">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail"
                            placeholder="Email Address">
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" name="roll" id="exampleInputId"
                            placeholder="Enter Your Teacher ID (Full ID)">
                    </div>
                </div>



                <div class="form-group">
                    <select name="department" id="" class="form-control">
                        <option value="">Select Department</option>

                        @if(Session::has('user_role') && Session::get('user_role') == 'SuperAdmin')
                        @foreach($departments as $d)
                        <option value="{{ $d->name }}">{{ $d->name }}</option>
                        @endforeach

                        @elseif(Session::has('user_role') && Session::get('user_role') == 'Admin')
                        @if($user_department)
                        <option value="{{ $user_department->name }}">{{ $user_department->name }}</option>
                        @endif
                        @endif
                    </select>
                </div>




                <div class="form-group row my-2">
                    <div class="form-group row my-2">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" class="form-control form-control-user" id="exampleInputPassword"
                                placeholder="Password" name="password">
                        </div>
                        <div class="col-sm-6">
                            <input type="password" class="form-control form-control-user" id="exampleRepeatPassword"
                                placeholder="Repeat Password" name="conf_password">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">Register as a Teacher</button>


            </form>
        </div>

    </div>
    @endsection