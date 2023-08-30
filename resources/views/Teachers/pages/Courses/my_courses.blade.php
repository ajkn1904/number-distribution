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
		@if(count($courses) == 0)
		<h1 class="text-center">No course allocated yet.</h1>

		@else
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<th>Name</th>
					<th>Code</th>
					<th>Type</th>
					<th>Credit</th>
					<th>Section</th>
					<th>Session</th>
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
						<td>{{$c->section}}</td>
						<td>{{$c->session_name}}</td>



						@php
						$isActive = false;
						foreach($existedMarks as $e) {
						if ($e->section_id == $c->id) {
						$isActive = true;
						break;
						}
						}
						@endphp


						<td class="w-20 d-flex gap-2">

							@if($isActive)
							<a href="{{ url('/teacher/my-courses/allocate/'.$c->id) }}"
								class="btn btn-success">Allocate</a>

							<a href="{{ url('/teacher/my-courses/show/'.$c->id) }}" class="btn btn-info">Show</a>

							<a href=" {{ url('/teacher/my-courses/edit/'.$c->id) }}" class="btn btn-warning">Edit</a>
							@else
							<a href="{{ url('/teacher/my-courses/distribute/'.$c->id) }}"
								class="btn btn-primary">Distribute
								Marks</a>
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>

			</table>
		</div>
		@endif
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




<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>
$(document).ready(function(){
    $("#session").change(function(){
        let sessionId = jQuery.noConflict();
        sessionId = $(this).val();
        $("#section").empty()
        let str = '<option value="">Select Section</option>'
        
        $.ajax({
            url: 'http://127.0.0.1:8000/api/sections/'+sessionId,
            dataType: "json",
            type: 'GET',
            success: function(res) {
                let sections = res.sections;
                let uniqueSections = [];
                sections.forEach(data => {
                    if (!uniqueSections.includes(data.section)) {
                            uniqueSections.push(data.section);
                            str += '<option value="'+data.section+'">'+data.section+'</option>'
                        }
                    });
                    $("#section").append(str);
            }
        })
    })
})
</script> -->