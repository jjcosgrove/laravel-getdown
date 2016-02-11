@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <p class="title">Documents</p>
                    <div class="controls pull-right">
                        @if(count($templates))
                            <select class="selectpicker-templates">
                                <option selected="selected" value="" autocomplete="off" disabled>FROM TEMPLATE...</option>
                                @foreach($templates as $template)
                                    <option value="{{ $template->id }}">{{ $template->title }}</option>
                                @endforeach
                            </select>
                        @endif
                        <a class="new-document" href="{{ route('create-new-document') }}" original-href="{{ route('create-new-document') }}"><button class="btn btn-default">New</button></a>
                    </div>
                </div>
                <div class="panel-body">
                    @if(count($documents))
                        <div class="list-group documents">
                        @foreach($documents as $document)
                            <a class="list-group-item document" href="{{ route('view-document', $document->id) }}">
                                <p class="title"><strong>{{ $document->title }}</strong></p>
                                <p class="description">{{ $document->description }}</p>
                            </a>
                        @endforeach
                        </div>
                    @else
                        You don't have any documents. Create some!
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
