<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.sitename') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ url('/font-awesome/css/font-awesome.css') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ url('/bootstrap/dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('/css/app.css') }}">

</head>
<body id="app-layout" ng-app="koronaApp">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">{{ trans('app.toggle_navigation') }}</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.sitename') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/dashboard') }}">{{ trans('app.dashboard') }}</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">{{ trans('auth.login') }}</a></li>
                    @else
                        <li uib-dropdown on-toggle="toggled(open)" class="dropdown">
                            <a href id="auth-menu" uib-dropdown-toggle role="button" aria-expanded="false">
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <ul uib-dropdown-menu aria-labelledby="auth-menu">
                                <li><a href="{{ url('/profile') }}">Mein Profil</a>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>{{ trans('auth.logout') }}</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @if (Session::has('error'))
            <div class="alert alert-danger col-md-10 col-md-offset-1">{{ Session::get('error') }}</div>
        @endif

        @yield('content')
    </div>

    <!-- JavaScripts -->
    <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">
    <script src="{{ url('/js/angular.min.js') }}"></script>
    <script src="{{ url('/js/ui-bootstrap-1.3.3.js') }}"></script>
    <script src="{{ url('/js/app.js') }}"></script>
</body>
</html>
