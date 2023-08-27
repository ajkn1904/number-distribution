@extends('sitelayouts.layouts.two_col')
@section('main-contents')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tables</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{url('/courses/all-courses')}}">All</a></li>
        <li class="breadcrumb-item active">Edit Course</li>
    </ol>
    <h1>Edit Course</h1>

    <form action="{{ url('/courses/update/'.$course->id) }}" method="post">
        @csrf
        <div class="form-group">
            <label for="">Name</label>
            <input value="{{$course ->name }}" type="text" name="name" class="form-control">
        </div>

        <div class="form-group">
            <label for="">Course Code</label>
            <input value="{{$course ->course_code }}" type="text" name="course_code" class="form-control">
        </div>

        <div class="row">
            <div class="col">
                <!-- Dropdown Select -->
                <div class="form-group">
                    <label for="">Credit</label>
                    <select name="credit" id="" class="form-control">
                        <option value="">Select Credit</option>
                        <option value="1" {{$course->credit == '1' ? 'selected' : ''}}>1</option>
                        <option value="1.5" {{$course->credit == '1.5' ? 'selected' : ''}}>1.5</option>
                        <option value="2" {{$course->credit == '2' ? 'selected' : ''}}>2</option>
                        <option value="3" {{$course->credit == '3' ? 'selected' : ''}}>3</option>
                        <option value="4" {{$course->credit == '4' ? 'selected' : ''}}>4</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">Type</label>
                    <select name="type" id="" class="form-control">
                        <option value="">Select Type</option>
                        <option value="Theory" {{$course->type=='Theory' ? 'selected':''}}>Theory</option>
                        <option value="Lab" {{$course->type=='Lab' ? 'selected':''}}>Lab</option>
                        <option value="Project" {{$course->type=='Project' ? 'selected':''}}>Project/Thesis</option>
                    </select>
                </div>
            </div>

        </div>


        <div class="form-group my-2">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>

    </form>
</div>
@endsection