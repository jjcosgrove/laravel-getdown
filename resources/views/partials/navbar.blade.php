<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-app-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><i class="fa fa-file-o"></i> GetDown</a>
        </div>
        <div class="collapse navbar-collapse navbar-app-collapse">
            <ul class="nav navbar-nav navbar-right">
                @if (!Auth::check())
                    <li><a href="{{ URL('/login') }}">Login</a></li>
                    <li><a href="{{ URL('/register') }}">Register</a></li>
                @else
                    @if(in_array(basename(Request::url()),array('documents','templates')))
                        <li><input id="search" class="hidden animated fadeIn" name="search" placeholder="Search..." type="text" data-list=".documents" autcomplete="off"></li>
                        <li><a class="search-toggle" href="#"><i class="fa fa fa-search"></i></a></li>
                    @endif
                    <li><a href="{{ Route('templates') }}">Templates</a></li>
                    <li><a href="{{ Route('documents') }}">Documents</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ Route('get-preferences') }}">Preferences</a></li>
                            <li><a href="{{ URL('/logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>