@extends('sitelayouts.layouts.two_col')
@section('main-contents')
<div class="container-fluid px-4">
	<h1 class="mt-4">Tables</h1>
	<ol class="breadcrumb mb-4">
		<li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="{{url('/teacher/my-courses')}}">Session</a></li>
		<li class="breadcrumb-item"><a href="{{url()->previous()}}">Courses</a></li>
		<li class="breadcrumb-item active"><a>Mark distribution</a></li>
	</ol>

	<div class="text-center">
		<h1 class="h4 text-gray-900 mb-4">Mark distribution</h1>
	</div>


	<div>
		<title>Mark distribution</title>

		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<th>Field Name</th>
					<th>Allocated Marks</th>
				</thead>
				<tbody>
					<!-- receiving data  -->
					@foreach($marks as $m)
					<tr>
						<td>Class Test One</td>
						<td>{{$m->class_test_one}}</td>
					</tr>
					<tr>
						<td>Class Test One</td>
						<td>{{$m->class_test_two}}</td>
					</tr>
					<tr>
						<td>Assignment/Performance</td>
						<td>{{$m->assessment}}</td>
					</tr>
					<tr>
						<td>Attendance</td>
						<td>{{$m->attendance}}</td>
					</tr>
					<tr>
						<td>Mid Term</td>
						<td>{{$m->mid_term}}</td>
					</tr>
					<tr>
						<td>Final Exam</td>
						<td>{{$m->final_exam}}</td>
					</tr>
					@endforeach
				</tbody>

			</table>
		</div>
		<a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>

		<a href="{{ url('/teacher/my-courses/edit/'.$m->section_id) }}" class="btn btn-warning m-1">Edit</a>
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