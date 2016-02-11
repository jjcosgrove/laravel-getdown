@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <form action="{{ route('save-template') }}" method="POST" autocomplete="off">
                {{ csrf_field() }}
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <p class="title">New Template</p>
                        <div class="controls pull-right">
                            <button class="btn btn-default" type="submit">Save</button>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <input class="form-control" name="title" placeholder="Title, e.g: README.md" required>
                            <input class="form-control" name="description" placeholder="Description" required>
                        </div>
                        <div id="epiceditor">
                            <textarea id="epiceditor_textarea" class="hidden" name="content"></textarea>
                        </div>
                    </div>
                </div>   
            </form>
        </div>
    </div>
</div>
@endsection
