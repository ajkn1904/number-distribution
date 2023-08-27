@extends('sitelayouts.layouts.two_col')
@section('main-contents')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tables</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{url('/session/all-session')}}">All</a></li>
        <li class="breadcrumb-item active">Edit Session</li>
    </ol>
    <h1>Edit Session</h1>

    <form action="{{ url('/session/update/'.$session->id) }}" method="post">
        @csrf
        <div class="form-group">
            <label for="">Name</label>
            <input value="{{$session ->name }}" type="text" name="name" class="form-control">
        </div>


        <div class="form-group">
            <label for="">Credit</label>
            <select name="duration" id="" class="form-control">
                <option value="">Select Duration</option>
                <option value="3 months" {{$session->duration == '3 months' ? 'selected' : ''}}>3 months</option>
                <option value="4 months" {{$session->duration == '4 months' ? 'selected' : ''}}>4 months</option>
                <option value="6 months" {{$session->duration == '6 months' ? 'selected' : ''}}>6 months</option>
            </select>
        </div>




        <div class="form-group my-2">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>

    </form>
</div>
@endsection