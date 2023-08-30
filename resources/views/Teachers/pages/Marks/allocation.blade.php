@extends('sitelayouts.layouts.two_col')
@section('main-contents')
<div class="container-fluid px-4">
	<h1 class="mt-4">Tables</h1>
	<ol class="breadcrumb mb-4">
		<li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="{{url('/teacher/my-courses')}}">Session</a></li>
		<li class="breadcrumb-item active"><a>All Courses</a></li>
	</ol>

	<div class="text-center">
		<h1 class="h4 text-gray-900 mb-4">All Courses</h1>

		<!-- showing success & error msg from Session to user-->
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


	</div>


	<div>
		<title>All Courses</title>

		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<th>Student's Email</th>
					<th>Ct1 ({{$marks->class_test_one}})</th>
					<th>Ct2 ({{$marks->class_test_two}})</th>
					<th>Attendance ({{$marks->attendance}})</th>
					<th>Assignment/performance ({{$marks->assessment}})</th>
					<th>Mid ({{$marks->mid_term}})</th>
					<th>Final ({{$marks->final_exam}})</th>
					<th>Action</th>
				</thead>
				<tbody>
					<!-- receiving data  -->
					@foreach($students as $s)
					<form action="{{ url('/teacher/my-courses/allocate/store/'.$s->id) }}" method="get">
						<tr>

							<td>{{$s->email}}</td>
							<td>
								<input type="text" name="ct1" @foreach($allocated as $a) @if($a->class_test_one &&
								$a->email == $s->email)
								value="{{$a->class_test_one}}"
								@endif @endforeach>
							</td>
							<td>
								<input type="text" name="ct2" @foreach($allocated as $a) @if($a->class_test_two &&
								$a->email == $s->email)
								value="{{$a->class_test_two}}"
								@endif @endforeach>
							</td>
							<td>
								<input type="text" name="attendance" @foreach($allocated as $a) @if($a->attendance &&
								$a->email == $s->email)
								value="{{$a->attendance}}"
								@endif @endforeach>
							</td>
							<td>
								<input type="text" name="assessment" @foreach($allocated as $a) @if($a->assessment &&
								$a->email == $s->email)
								value="{{$a->assessment}}"
								@endif @endforeach>
							</td>
							<td>
								<input type="text" name="mid" @foreach($allocated as $a) @if($a->mid_term && $a->email
								== $s->email)
								value="{{$a->mid_term}}"
								@endif @endforeach>
							</td>
							<td>
								<input type="text" name="final_exam" @foreach($allocated as $a) @if($a->final_exam &&
								$a->email == $s->email)
								value="{{$a->final_exam}}"
								@endif @endforeach>
							</td>

							<td class="w-20 d-flex gap-2">
								<button type="submit" class="btn btn-success">Allocate</button>
							</td>

						</tr>
					</form>
					@endforeach
				</tbody>

			</table>
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