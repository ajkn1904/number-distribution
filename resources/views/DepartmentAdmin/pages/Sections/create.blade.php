@extends('sitelayouts.layouts.two_col')
@section('main-contents')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tables</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{url('/section/all-section')}}">All</a></li>
        <li class="breadcrumb-item active">Create Section</li>
    </ol>

    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Create new Section</h1>

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

    <form action="{{ url('/section/creation') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="">Section</label>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="A" name="section">A
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="B" name="section">B
                </label>
            </div>
            <div class="form-check disabled">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="C" name="section">C
                </label>
            </div>
            <div class="form-check disabled">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="C" name="section">C
                </label>
            </div>
            <div class="form-check disabled">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="D" name="section">D
                </label>
            </div>
            <div class="form-check disabled">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="E" name="section">E
                </label>
            </div>
        </div>



        <div class="form-group mt-2">
            <label for="">Session</label>
            <select name="session_id" id="" class="form-control">
                <option value="">Select Session</option>

                @foreach($sessions as $s)

                <option value="{{$s ->id}}">{{$s -> name}}</option>

                @endforeach

            </select>
        </div>



        <div class="form-group mt-2">
            <label for="">Courses</label>
            <select name="course_id" id="" class="form-control">
                <option value="">Select Courses</option>

                @foreach($courses as $c)

                <option value="{{$c ->id}}">{{$c -> name}}</option>

                @endforeach

            </select>
        </div>



        <div class="form-group my-2">
            <label for="">Department</label>
            <select name="department_id" id="" class="form-control">
                <option value="">Select Department</option>

                @foreach($departments as $d)

                <option value="{{$d ->id}}">{{$d -> name}}</option>

                @endforeach

            </select>
        </div>



        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

    </form>
</div>
@endsection