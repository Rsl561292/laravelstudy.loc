<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ruslan Shyiovych">
    <link rel="icon" href="{{ \Illuminate\Support\Facades\URL::asset('bootstrap/favicon.ico') }}">

    <title>{{ $pageName }}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ \Illuminate\Support\Facades\URL::asset('bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- My code CSS -->
    <link href="{{ \Illuminate\Support\Facades\URL::asset('css/admin-style.css') }}" rel="stylesheet">


</head>

<body>

@section('navbar')
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="{{ route("home") }}">LaravelStudy</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            @if($userName != null)
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route("admin-home") }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("admin-users") }}">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("admin-logout") }}">Logout</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("admin-login") }}">Login</a>
                </li>
            @endif

                {{--
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                     {{--
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>--}}
        </ul>
    </div>

    <div class="admin">
        @if($userName != null)
            <h5>User: {{ $userName }}</h5>
        @else
            <h5>User: Guest</h5>
        @endif
    </div>
</nav>
@show

<main role="main">

    @section('page-name')
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <center><h3 class="display-4">{{ $pageName }}</h3></center>
            <center><p>This is a main page admin.</p></center>
        </div>
    </div>
    @show

    @section('content')
    <div class="container">
        <!-- Example row of columns -->
        <div class="row">
            <div class="col-md-4">
                <h2>Heading</h2>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
            </div>
            <div class="col-md-4">
                <h2>Heading</h2>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
            </div>
            <div class="col-md-4">
                <h2>Heading</h2>
                <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
            </div>
        </div>
    </div> <!-- /container -->
    @show

</main>

@section('footer')

    @getMessage('This page is intendent for sign in uor site')
<footer class="container">
    <p>&copy; Company 2017-2018</p>
</footer>
@show

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="{{ \Illuminate\Support\Facades\URL::asset('bootstrap/assets/js/vendor/jquery-slim.min.js') }}"><\/script>')</script>
<script src="{{ \Illuminate\Support\Facades\URL::asset('bootstrap/assets/js/vendor/popper.min.js') }}"></script>
<script src="{{ \Illuminate\Support\Facades\URL::asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>
</html>
