@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <p class="title">Home</p>
                </div>
                <div class="panel-body">
                    <p>This is a simple Laravel-based Markdown application.</p>
                    <p><strong>Current features include:</strong></p>
                    <ul>
                        <li>Basic accounts</li>
                        <li>Templates/New from template</li>
                        <li>Live edit/previewof Markdown</li>
                        <li>Fullscreen mode</li>
                    </ul>
                    <p><strong>Future features may include:</strong></p>
                    <ul>
                        <li>Tidy up/refactor</li>
                        <li>Fully searchable documents</li>
                        <li>Tag support</li>
                        <li>Lots more</li>
                    </ul>
                    <p>You can grab the latest version from <a target="_blank" href="https://github.com/jjcosgrove/laravel-getdown">GitHub <i class="fa fa-github"></i></a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
