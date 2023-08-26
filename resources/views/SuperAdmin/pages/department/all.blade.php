@extends('sitelayouts.layouts.two_col')
@section('main-contents')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tables</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{url('/department/create')}}">Create</a></li>
        <li class="breadcrumb-item active">All</li>
    </ol>

    <h1>All Department</h1>
    <title>All Departments</title>
    <table class="table table-striped">
        <thead>
            <th>Name</th>
            <th>Established</th>
            <th>Building</th>
        </thead>
        <tbody>
            <!-- receiving data  -->
            @foreach($departments as $d)
            <tr>
                <td>{{$d->name}}</td>
                <td>{{$d->established_at}}</td>
                <td>{{$d->building}}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection