@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <p class="title">Templates</p>
                    <div class="controls pull-right">
                        <a href="{{ route('create-new-template') }}"><button class="btn btn-default">New</button></a>
                    </div>
                </div>
                <div class="panel-body">
                    @if(count($templates))
                        <div class="list-group documents">
                        @foreach($templates as $template)
                            <a class="list-group-item document" href="{{ route('view-template', $template->id) }}">
                                <p class="title"><strong>{{ $template->title }}</strong></p>
                                <p class="description">{{ $template->description }}</p>
                            </a>
                        @endforeach
                        </div>
                    @else
                        You don't have any templates. Create some!
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@if(Session::has('message'))
    <div class="message-popup">
        <div class="alert alert-info message" role="alert">
            <p>{{ Session::get('message') }}</p>
        </div>
    </div>
@endif
@endsection
