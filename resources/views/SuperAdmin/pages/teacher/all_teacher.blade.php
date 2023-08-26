@extends('sitelayouts.layouts.two_col')
@section('main-contents')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Pending Users</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">All</li>
        <li class="breadcrumb-item"><a href="{{url('/teacher/create')}}">Create Teacher</a></li>
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
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teachers as $t)
                        <tr>
                            <td>{{ $t->first_name}} {{ $t->last_name }}</td>
                            <td>{{ $t->email }}</td>
                            <td>
                                {{ $t->department }}
                            </td>

                            <td>
                                @if($t->role== 'Admin')
                                <span class="badge bg-success">Admin</span>
                                @else
                                <span class="badge bg-primary">Teacher</span>
                                @endif
                            </td>

                            @if(Session::has('user_role') && Session::get('user_role')=='SuperAdmin')

                            <td>
                                @if($t->role== 'Admin')
                                <a class="btn btn-sm btn-secondary disabled"
                                    href="{{ url('/make-admin/'.$t->id) }}">Make
                                    Admin</a>
                                @else
                                <a class="btn btn-sm btn-primary" href="{{ url('/make-admin/'.$t->id) }}">Make Admin</a>
                                @endif
                            </td>
                            @endif


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