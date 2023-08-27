@extends('sitelayouts.layouts.two_col')
@section('main-contents')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tables</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{url('/session/create')}}">Create</a></li>
        <li class="breadcrumb-item active">All</li>
    </ol>
    <title>All Sessions</title>

    <h1>All Sessions</h1>
    <table class="table table-striped">
        <thead>
            <th>Name</th>
            <th>Duration</th>
            <th>Department</th>
            <th>Status</th>
            <th>Action</th>
        </thead>
        <tbody>
            <!-- receiving data  -->
            @foreach($session as $s)
            <tr>
                <td>{{$s->name}}</td>
                <td>{{$s->duration}}</td>
                <td>{{$s->department}}</td>
                @if($s->status == 1)
                <td class="badge bg-success text-white">Running</td>
                @else
                <td class="badge bg-secondary text-white">Expire</td>
                @endif

                <td>
                    <a href="{{ url('/session/edit/'.$s->id) }}" class="btn btn-primary">Edit</a>

                    @if($s->status == 1)
                    <a href="{{ url('/session/expire/'.$s->id) }}" class="btn btn-warning my-2 lg:m-2">Expire</a>
                    @else
                    <a href="{{ url('/session/running/'.$s->id) }}" class="btn btn-success m-2">Running</a>
                    @endif

                    <a href="" class="btn btn-danger" data-toggle="modal"
                        data-target="#deleteSessionModal{{$s->id}}">Delete</a>
                    <!-- Delete confirmation using modal -->
                    <div class="modal" id="deleteSessionModal{{$s->id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Delete Confirmation</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <div class="modal-body">
                                    Are you sure you want to delete?<b>{{$s->name}}</b>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a href="{{ url('/session/delete/'.$s->id)}}" class=" btn btn-danger">Yes</a>
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