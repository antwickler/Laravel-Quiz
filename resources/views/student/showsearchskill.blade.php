@extends('template')

@section('title','Student Profile')

@section('content')

	@foreach( $students as  $index => $item )
		<div>
			{{$NUM_PAGE*($page-1) + $index+1}}) <label for="Name">Name</label> {{$item->name}}<br>
			<label for="Email">Email:</label>{{$item->email}}<br>
			<label for="Major">Major:</label>{{$item->major}}
			<div>
				<b>Skills:</b>
				@foreach($item->skills as $cskill)
					<a href="/students/searchSkill/{{$cskill->id}}" class="btn btn-info"> {{$cskill->name}}</a>
				@endforeach
			</div>
			
			<br>
			@can('show',$item)		
				<form method="post" action="students/{{$item->id}}" class="form-inline">
					<a href="students/{{$item->id}}" class="btn btn-primary">Show</a> | 
					<a href="students/{{$item->id}}/edit" class="btn btn-success">Edit</a> |		
					<input type="hidden" name="_method" value="Delete">
					<button class="btn btn-danger">Delete</button> 
					{{csrf_field()}}
				</form>
			@endcan
			
			<div>
				Last update: {{$item->updated_at}}
			</div>	
		</div>
		<hr>
	@endforeach

	<a href="/students">Home</a>

@endsection