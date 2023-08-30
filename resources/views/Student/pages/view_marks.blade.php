@extends('sitelayouts.layouts.two_col')
@section('main-contents')
<div class="container-fluid px-4">
	<h1 class="mt-4">Tables</h1>
	<ol class="breadcrumb mb-4">
		<li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="{{url()->previous()}}">Courses</a></li>
		<li class="breadcrumb-item active"><a>Mark distribution</a></li>
	</ol>

	<div class="text-center">
		<h1 class="h4 text-gray-900 mb-4">Mark distribution</h1>

	</div>


	<div>
		<title>Mark distribution</title>
		<h3>Corse Name: <span class="text-info">{{$marks ->name}}</span></h3>
		<h3>Corse Code: <span class="text-info">{{$marks ->course_code}}</span></h3>
		<h3>Corse Type: <span class="text-info">{{$marks ->type}}</span></h3>


		<div class="table-responsive mt-3">
			<table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<th>Field Name</th>
					<th>Allocated Marks</th>
				</thead>
				<tbody>
					<!-- receiving data  -->

					<tr>
						<td>Class Test One</td>
						<td>@if($marks->class_test_one){{$marks->class_test_one}}
							@else N/A @endif
						</td>
					</tr>
					<tr>
						<td>Class Test One</td>
						<td>@if($marks->class_test_two) {{$marks->class_test_two}}
							@else N/A @endif
						</td>
					</tr>
					<tr>
						<td>Assignment/Performance</td>
						<td>@if($marks->assessment) {{$marks->assessment}} @else N/A @endif</td>
					</tr>
					<tr>
						<td>Attendance</td>
						<td>@if($marks->attendance) {{$marks->attendance}} @else N/A @endif</td>
					</tr>
					<tr>
						<td>Mid Term</td>
						<td>@if($marks->mid_term) {{$marks->mid_term}} @else N/A @endif</td>
					</tr>
					<tr>
						<td>Final Exam</td>
						<td>@if($marks->final_exam) {{$marks->final_exam}} @else N/A @endif</td>
					</tr>

				</tbody>

			</table>
		</div>
		<a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
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