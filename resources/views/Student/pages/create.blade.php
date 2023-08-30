@extends('sitelayouts.layouts.two_col')
@section('main-contents')
<div class="container-fluid px-4">
	<h1 class="mt-4">Tables</h1>
	<ol class="breadcrumb mb-4">
		<li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
		<li class="breadcrumb-item active">Enrollment</li>
		<li class="breadcrumb-item"><a href="{{url('/enrollment/my-courses')}}">My_Courses</a></li>
	</ol>

	<div class="text-center">
		<h1 class="h4 text-gray-900 mb-4">Enrollment</h1>

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

	<!-- setting url to store data to the database -->

	<form action="{{ url('/enrollment/create/course') }}" method="get">
		@csrf

		<div class="form-group mt-2">
			<label for="">Session</label>
			<select name="session_id" id="session" class="form-control">
				<option value="">Select Session</option>

				@foreach($sessions as $s)

				<option value="{{$s ->id}}">{{$s -> name}}</option>

				@endforeach

			</select>
		</div>

		<label for="">Section</label>
		<select name="section" id="section" class="form-control">
			<option value="">Select Section</option>
		</select>


		<div class="form-group my-2">
			<button type="submit" class="btn btn-primary">Go</button>
		</div>

	</form>
</div>
@endsection




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>
$(document).ready(function() {
	$("#session").change(function() {
		let sessionId = jQuery.noConflict();
		sessionId = $(this).val();
		$("#section").empty()
		let str = '<option value="">Select Section</option>'

		$.ajax({
			url: 'http://127.0.0.1:8000/api/sections/' + sessionId,
			dataType: "json",
			type: 'GET',
			success: function(res) {
				let sections = res.sections;
				let uniqueSections = [];
				sections.forEach(data => {
					if (!uniqueSections.includes(data.section)) {
						uniqueSections.push(data.section);
						str += '<option value="' + data.section + '">' + data
							.section + '</option>'
					}
				});
				$("#section").append(str);
			}
		})
	})
})
</script>