@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <p class="title">View Template</p>
                    <div class="controls pull-right">
                        <a class="export" href="#"><button class="btn btn-warning" type="submit">Export</button></a>
                        <a href="{{ route('edit-template', $template->id) }}"><button class="btn btn-default" type="submit">Edit</button></a>
                        <a href="{{ route('delete-template', $template->id) }}"><button class="btn btn-danger" type="submit">Delete</button></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="document">
                        <p class="title">{{ $template->title }}</p>
                        <p class="description">{{ $template->description }}</p>
                    </div>
                    <hr>
                    <div id="epiceditor" class="readonly">
                        <textarea id="epiceditor_textarea" class="hidden" name="content">{{ $template->content }}</textarea>
                    </div>
                </div>
            </div>   
        </div>
    </div>
</div>
@endsection
