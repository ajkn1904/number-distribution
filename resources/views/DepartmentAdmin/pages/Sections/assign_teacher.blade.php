@extends('sitelayouts.layouts.two_col')
@section('main-contents')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Assign Teacher</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item">
            <a href="{{url('/section/all-section')}}">All Section </a>
        </li>
        <li class="breadcrumb-item active"><a>Assign Teacher</a></li>
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

    <form action="{{ url('/section/update/'.$sections->id) }}" method="post">
        @csrf


        <div class="form-group my-2">
            <label for="">Teacher</label>
            <select name="teacher_id" id="" class="form-control">
                <option value="">Select Teacher</option>

                @foreach($teachers as $t)

                <option value="{{$t->id}}">{{ $t->first_name}} {{ $t->last_name }}</option>

                @endforeach

            </select>
        </div>



        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

    </form>

</div>
@endsection

@section('scripts')
<!-- Page level plugins -->
<script src="{{ asset('assets/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('assets/admin/js/demo/datatables-demo.js') }}"></script>
@endsection