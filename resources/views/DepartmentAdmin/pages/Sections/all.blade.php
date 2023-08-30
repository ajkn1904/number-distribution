@extends('sitelayouts.layouts.two_col')
@section('main-contents')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">All Section</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">All</li>
        <li class="breadcrumb-item"><a href="{{url('/section/create')}}">Create Section</a></li>
    </ol>

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

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Section</th>
                            <th>Session</th>
                            <th>Course</th>
                            <th>Department</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach($sections as $s)
                        <tr>
                            <td>{{ $s->section}}</td>

                            <td>
                                @foreach($session as $ses)

                                @if(($s->session_id == $ses->id) && ($ses->status == true))
                                {{ $ses->name }}

                                @elseif(($s->session_id == $ses->id) && ($ses->status == false) )
                                <span class="badge bg-secondary">Expired</span>
                                @endif

                                @endforeach

                            </td>

                            <td>
                                @foreach($courses as $c)
                                @if($s->course_id == $c->id)
                                {{ $c->name }}
                                @endif
                                @endforeach
                            </td>

                            <td>
                                {{ $department->name }}
                            </td>
                            <td>
                                @if($s->status == 1)
                                <span class="badge bg-success">Assigned</span> to
                                @foreach($teachers as $t)
                                @if($s->teacher_id == $t->id)
                                {{ $t->first_name }} {{ $t->last_name }}
                                @endif
                                @endforeach
                                @else
                                <span class="badge bg-primary">Not Assigned</span>
                                @endif
                            </td>

                            <td>
                                @if($s->status == 1)
                                <a class="btn btn-sm btn-secondary disabled"
                                    href="{{ url('/section/assign/'.$s->id) }}">Assign
                                    Teacher</a>
                                @else
                                <a class="btn btn-sm btn-primary" href="{{ url('/section/assign/'.$s->id) }}">Assign
                                    Teacher</a>
                                @endif

                                <a href="" class="btn btn-danger" data-toggle="modal"
                                    data-target="#deleteSectionModal{{$s->id}}">Delete</a>
                                <!-- Delete confirmation using modal -->
                                <div class="modal" id="deleteSectionModal{{$s->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Delete Confirmation</h4>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                Are you sure you want to delete?<b>{{$s->section}}</b>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <a href="{{ url('/section/delete/'.$s->id)}}"
                                                    class=" btn btn-danger">Yes</a>
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
        </div>
    </div>

</div>
@endsection

@section('scripts')
<!-- Page level plugins -->
<script src="{{ asset('assets/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('assets/admin/js/demo/datatables-demo.js') }}"></script>
@endsection