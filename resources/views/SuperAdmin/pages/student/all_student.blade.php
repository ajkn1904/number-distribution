@extends('sitelayouts.layouts.two_col')
@section('main-contents')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Pending Users</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">All</li>
        <li class="breadcrumb-item"><a @if(Session::has('user_role') && (Session::get('user_role')=='SuperAdmin' ))
                href="{{url('/student/create')}}" @elseif(Session::has('user_role') &&
                (Session::get('user_role')=='Admin' )) href="{{url('/student/department-create')}}" @endif>Create
                Student</a></li>
    </ol>

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
                        </tr>
                    </thead>
                    <tbody>
                        @if(Session::has('user_role') && (Session::get('user_role')=='SuperAdmin' ))
                        @foreach($students as $s)
                        <tr>
                            <td>{{ $s->first_name}} {{ $s->last_name }}</td>
                            <td>{{ $s->email }}</td>
                            <td>
                                {{ $s->department }}
                            </td>

                        </tr>

                        @endforeach

                        @elseif(Session::has('user_role') && (Session::get('user_role')=='Admin' ))
                        @foreach($sameDepartmentStudents as $s)
                        <tr>
                            <td>{{ $s->first_name}} {{ $s->last_name }}</td>
                            <td>{{ $s->email }}</td>
                            <td>
                                {{ $s->department }}
                            </td>

                        </tr>

                        @endforeach

                        @endif
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