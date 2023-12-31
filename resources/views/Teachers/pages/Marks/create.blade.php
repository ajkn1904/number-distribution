@extends('sitelayouts.layouts.two_col')
@section('main-contents')
<div class="container-fluid px-4">
	<h1 class="mt-4">Tables</h1>
	<ol class="breadcrumb mb-4">
		<li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="{{url()->previous()}}">Courses</a></li>
		<li class="breadcrumb-item active">Distribute Marks</li>
	</ol>
	<h3>Corse Name: <span class="text-info">{{$courses ->name}}</span></h3>
	<h3>Corse Code: <span class="text-info">{{$courses ->course_code}}</span></h3>
	<h3>Corse Type: <span class="text-info">{{$courses ->type}}</span></h3>
	<h3>Section : <span class="text-info">{{$courses ->section}}</span></h3>

	<h1 class="mt-4">Distribute Marks out of 100</h1>

	@if(Session::has('success'))
	<div class="alert alert-success">

		{{Session::get('success')}}

	</div>
	@endif


	@if(Session::has('error'))
	<div class="alert alert-danger">

		{{Session::get('error')}}
		<p>Back to courses</p>

	</div>
	@endif


	<form action="{{ url('/teacher/my-courses/distribute/store/'.$courses->id) }}" method="post">
		@csrf
		<div class="row mt-2">
			<div class="col">
				<div class="form-group">
					<label for="">Class test 1</label>
					<input value="" type="text" name="ct1" class="form-control">
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<label for="">Class test 2</label>
					<input value="" type="text" name="ct2" class="form-control">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col">
				<div class="form-group">
					<label for="">Assignment/Performance</label>
					<input value="" type="text" name="assessment" class="form-control">
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<label for="">Attendance</label>
					<input value="" type="text" name="attendance" class="form-control">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col">
				<div class="form-group">
					<label for="">Mid Term</label>
					<input value="" type="text" name="mid" class="form-control">
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<label for="">Final</label>
					<input value="" type="text" name="final_exam" class="form-control">
				</div>
			</div>
		</div>



		<div class="form-group my-2">
			<button type="submit" class="btn btn-primary mx-3">Save</button>
			<a href="{{url()->previous()}}" class="btn btn-secondary">Back</a>

		</div>

	</form>
</div>
@endsection