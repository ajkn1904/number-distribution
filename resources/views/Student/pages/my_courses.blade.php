@extends('sitelayouts.layouts.two_col')
@section('main-contents')
<div class="container-fluid px-4">
	<h1 class="mt-4">Tables</h1>
	<ol class="breadcrumb mb-4">
		<li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="{{url('/enrollment/create')}}">Create</a></li>
		<li class="breadcrumb-item active">My Courses</li>
	</ol>
	<title>My Courses</title>

	<h1>Enroll Courses</h1>
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
							<th>Course</th>
							<th>Course Code</th>
							<th>Course Type</th>
							<th>Credit</th>
							<th>Section</th>
							<th>Session</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>


						@foreach($courses as $c)
						<tr>
							<td>{{ $c->name}}</td>
							<td>{{ $c->course_code}}</td>
							<td>{{ $c->type}}</td>
							<td>{{ $c->credit}}</td>
							<td>
								{{ $c->section}}
							</td>
							<td>
								{{ $c->name }}
							</td>


							<!-- <td>
								
									<span class="badge bg-success">Active</span>
								
									<span class="badge bg-primary">Inactive</span>
							
                            </td> -->

							<td>
								<a class="btn btn-sm btn-primary"
									href="{{ url('/enrollment/my-courses/view/'.$c->section_id) }}">View Marks</a>
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