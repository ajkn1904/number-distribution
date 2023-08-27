@extends('sitelayouts.layouts.two_col')
@section('main-contents')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tables</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{url('/courses/all-courses')}}">All</a></li>
        <li class="breadcrumb-item active">Create Course</li>
    </ol>

    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Create new Course</h1>

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

    <form action="{{ url('/courses/creation') }}" method="post">
        @csrf
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" class="form-control form-control-user" name="name" id="exampleFirstName"
                    placeholder="Course Name">
            </div>
            <div class="col-sm-6">
                <input type="text" class="form-control form-control-user" name="course_code" id="exampleFirstName"
                    placeholder="Course Code">
            </div>
        </div>



        <div class="row my-2">
            <div class="col">
                <!-- Dropdown Select -->
                <div class="form-group">
                    <label for="">Credit</label>
                    <select name="credit" id="" class="form-control">
                        <option value="">Select Credit</option>
                        <option value="1">1</option>
                        <option value="1.5">1.5</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">Type</label>
                    <select name="courseType" id="" class="form-control">
                        <option value="">Select Type</option>
                        <option value="Theory">Theory</option>
                        <option value="Lab">Lab</option>
                        <option value="Project">Project/Thesis</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">Department</label>
                    <select name="departmentName" id="" class="form-control">
                        <option value="">Select Department</option>

                        @foreach($departments as $d)

                        <option value="{{$d ->name}}">{{$d -> name}}</option>

                        @endforeach

                    </select>
                </div>

            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

    </form>
</div>
@endsection