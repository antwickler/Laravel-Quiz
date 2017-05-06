@extends('template')

@section('title','Student Profile')

@section('content')

	@if (count($errors) > 0)
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif

	<form method="post" action="/students">
		<legend>New Student</legend>
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" name="name" class="form-control" placeholder="Name">
		</div>		
		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" name="email" class="form-control" placeholder="Email">
		</div>
		<label for="major">Major</label>
		<label class="checkbox-inline">
			<input type="radio" name="major" value="1"> CoE&nbsp;
		</label>
		<label class="checkbox-inline">
			<input type="radio" name="major" value="2"> IT &nbsp;
		</label>
		<label class="checkbox-inline">
			<input type="radio" name="major" value="3"> SE &nbsp;
		</label>
		<label class="checkbox-inline">
			<input type="radio" name="major" value="4"> E-Biz &nbsp;
		</label><br>
		<label for="skills">Skill &nbsp;&nbsp;&nbsp;</label>
		@foreach ( $skills as $skill)
			<label class="checkbox-inline">
				<input type="checkbox" name="skills[]" value="{{$skill->id}}"> {{$skill->name}} &nbsp; 
			</label>
		@endforeach

		<div>
			<b>From: </b> {{ Auth::user()->name}} <br><br>
			<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
		</div>
		{{csrf_field()}}	
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
	
	<br><br>
	<p align="center">
		<a href="/students" class="btn btn-success">Home</a>
		<br><br>
	</p>

@endsection