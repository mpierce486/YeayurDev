<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	<meta name="description" content="Yeayur is an online social platform that enables game streamers to market themselves and helps fans find and connect with their favorite streamers.">
    <link rel="icon" href="{{ asset('images/Untitled.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="{{ asset('css/editprofile.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/forgotpasswordstyles.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/globalstyles.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/loginstyles.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/registerstyles.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/streamerstyles.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/mainstyles.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/supportstyles.css') }}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.2/masonry.pkgd.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/X.Y.Z/angular-route.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/ngInfiniteScroll/1.2.1/ng-infinite-scroll.min.js"></script>
    <script src="{{ asset('js/angular-route.js') }}"></script>
    <script src="{{ asset('js/loginscripts.js') }}"></script>
    <script src="{{ asset('js/streamerscripts.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
    <script src="{{ asset('/js/jquery.infinitescroll.min.js') }}"></script>
    <title>Yeayur - Connecting Game Streamers and Fans</title>
</head>

<nav class="navbar navbar-header navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand navbar-header-brand navbar-logo login-logo" href="{{ route('home') }}"><img src="{{ asset('images/logo_856469_web.png') }}" class="login-logo"/></a>
    </div>
  </div>
</nav>

<body>

    <div class="container">
        @yield('content')
    </div>
    <!-- INCLUDE FOOTER SECTION TEMPLATE -->
    @include('templates.partials.footer')
</body>
</html>