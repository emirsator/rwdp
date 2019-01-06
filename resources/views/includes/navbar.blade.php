<!-- Navigation -->
<nav class="navbar navbar-default navbar-top margin-bottom-0" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                @can('manage-users')
                    <li><a href="{{ route('users') }}">@lang('label.users')</a></li>
                @endcan
                
                <li>
                    <a href="" 
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" 
                            action="{{ url('/logout') }}" 
                        method="POST" 
                        style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </form>
                </li>
                <li class="hidden">
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="@lang('label.search')">
                        </div>
                    </form>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>