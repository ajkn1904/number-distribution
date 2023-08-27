@extends('sitelayouts.layouts.two_col')
@section('main-contents')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tables</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{url('/courses/create')}}">Create</a></li>
        <li class="breadcrumb-item active">All</li>
    </ol>

    <h1>All Department</h1>
    <title>All Departments</title>
    <table class="table table-striped">
        <thead>
            <th>Name</th>
            <th>Code</th>
            <th>Type</th>
            <th>Credit</th>
            <th>Department</th>
            <th>Action</th>
        </thead>
        <tbody>
            <!-- receiving data  -->
            @foreach($courses as $c)
            <tr>
                <td>{{$c->name}}</td>
                <td>{{$c->course_code}}</td>
                <td>{{$c->type}}</td>
                <td>{{$c->credit}}</td>
                <td>{{$c->department}}</td>


                <td>
                    <a href="{{ url('/courses/edit/'.$c->id) }}" class="btn btn-secondary">Edit</a>

                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$c->id}}">Delete</a>


                    <!-- Delete confirmation using modal -->
                    <div class="modal" id="myModal{{$c->id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Delete Confirmation</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <div class="modal-body">
                                    Are you sure you want to delete?<b>{{$c->name}}</b>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a href="{{ url('/courses/delete/'.$c->id)}}" class=" btn btn-danger">Yes</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection