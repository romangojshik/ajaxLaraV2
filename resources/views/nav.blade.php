<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="collapsed navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-6" aria-expanded="false"><span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
            <a href="/my/account" class="navbar-brand">Laravel</a></div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-6">

            <ul class="nav navbar-nav">
                <li><a href="/my/account/show">All posts</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ route('logout') }}">Sign out</a></li>
            </ul>

        </div>
    </div>
</nav>