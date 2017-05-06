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

	<form method="post" action="/students/{{$student->id}}">
		<legend>Edit message</legend>
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" name="name" class="form-control" value="{{$student->name}}"  placeholder="Name">
		</div>		
		<div class="form-group">
			<label for="body">Body</label>
			<input type="email" name="email" class="form-control" value="{{$student->email}}"  placeholder="Email">
		</div>
		<label for="Email">Major:</label>
		<label class="checkbox-inline">
			@if($student->major == 'CoE')
				<input type="radio" name="major" value="1" checked> CoE&nbsp;
			@else
				<input type="radio" name="major" value="1" > CoE&nbsp;
			@endif
		</label>
		<label class="checkbox-inline">
			@if($student->major == 'IT')
				<input type="radio" name="major" value="2" checked> IT&nbsp;
			@else
				<input type="radio" name="major" value="2" > IT&nbsp;
			@endif
		</label>
		<label class="checkbox-inline">
			@if($student->major == 'SE')
				<input type="radio" name="major" value="3" checked> SE&nbsp;
			@else
				<input type="radio" name="major" value="3" > SE&nbsp;
			@endif
		</label>
		<label class="checkbox-inline">
			@if($student->major == 'E-Biz')
				<input type="radio" name="major" value="4" checked> E-Biz&nbsp;
			@else
				<input type="radio" name="major" value="4" > E-Biz&nbsp;
			@endif
		</label><br>
		<label for="Email">Skill:</label>
			@foreach($skills as $skill)
				<!--  {{$chk = ''}} -->
				@foreach($student->skills as $cskill)
					@if( $skill->id == $cskill->id)
					<!-- {{$chk = 'checked'}} -->
					@endif
				@endforeach
				<input type="checkbox" name="skills[]" value="{{$skill->id}}" {{$chk}}> {{$skill->name}} &nbsp;
			@endforeach

		<br>
		<b>From: </b> {{ Auth::user()->name}} <br>
		<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
	 
		<input type="hidden" name="_method" value="PUT">
		{{csrf_field()}}	
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>

	<br>
	<a href="/students">Home</a>

@endsection