@extends('template')

@section('title','Student Profile')

@section('content')

	<label for="Name">Name</label> {{$student->name}}<br>
	<label for="Email">Email:</label>{{$student->email}}<br>
	<label for="Major">Major:</label>{{$student->major}}
	<div>
		<b>Skills:</b>
		@foreach($student->skills as $cskill)
			<a href="/students/searchSkill/{{$cskill->id}}" class="btn btn-info"> {{$cskill->name}}</a>
		@endforeach
	</div>
	
	<br>
	<b>From: </b> {{ Auth::user()->name}} <br>
	
	@can('show',$student)		
		<form method="post" action="/students/{{$student->id}}" class="form-inline">
			<a href="{{$student->id}}" class="btn btn-primary">Show</a> | 
			<a href="{{$student->id}}/edit" class="btn btn-success">Edit</a> |		
			<input type="hidden" name="_method" value="Delete">
			<button class="btn btn-danger">Delete</button> 
			{{csrf_field()}}
		</form>
	@endcan
	
	<hr>
	<a href="/students">Home</a>
	<br>

@endsection