@extends('sitelayouts.layouts.two_col')
@section('main-contents')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tables</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{url('/department/all')}}">All</a></li>
        <li class="breadcrumb-item active">Create Department</li>
    </ol>

    <h1>Create new Department</h1>

    <!-- setting url to store data to the database -->

    <form action="{{ url('/department/store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Established</label>
            <input type="date" name="established" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Building</label>
            <input type="text" name="building" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

    </form>
</div>
@endsection