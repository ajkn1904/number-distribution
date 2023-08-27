@extends('sitelayouts.layouts.two_col')
@section('main-contents')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tables</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{url('/session/all-session')}}">All</a></li>
        <li class="breadcrumb-item active">Create Session</li>
    </ol>

    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Create new Session</h1>

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

    <!-- setting url to store data to the database -->

    <form action="{{ url('/session/creation') }}" method="post">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control form-control-user" name="name" id="exampleFirstName"
                placeholder="Session Name">
        </div>



        <div class="row my-2">
            <div class="col">
                <!-- Dropdown Select -->
                <div class="form-group">
                    <label for="">Credit</label>
                    <select name="duration" id="" class="form-control">
                        <option value="">Select Duration</option>
                        <option value="3 months">3 months</option>
                        <option value="4 months">4 months</option>
                        <option value="6 months">6 months</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="">Department</label>
                <select name="department" id="" class="form-control">
                    <option value="">Select Department</option>

                    @foreach($departments as $d)

                    <option value="{{$d ->name}}">{{$d -> name}}</option>

                    @endforeach

                </select>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

    </form>
</div>
@endsection