@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">404</div>
                <div class="panel-body">
                    You made a boo-boo. Go <a href="{{ Route('home') }}">home</a> and try again.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
