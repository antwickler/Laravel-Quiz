@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>

                @if ( !Auth::guest() )
                    <p align="center">
                        <a href="/students" class="btn btn-primary">Student Profile</a>
                        <br><br>
                    </p>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
