<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" ng-app>
    <title>@yield('title', 'Time Clock')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Clock</title>
    <meta name="viewport" content="width=device-width">
    {{ HTML::style('css/reset-min.css'}
    {{ HTML::style('css/StyleApp.css'}
    {{ HTML::style('css/fancyInput.css'}
    {{ HTML::style('css/jquery-ui-1.10.3.custom.min.css'}
    {{ HTML::style('css/toastr.min.css'}
    {{ HTML::style('css/fancySelect.css'}
    {{ HTML::style('css/animate.min.css'}

    <!--[if lt IE 9]> {{ HTML::script('http://html5shim.googlecode.com/svn/trunk/html5.js'}<![endif]-->
    {{ HTML::script('js/jquery-1.9.1.min.js'
    {{ HTML::script('js/jquery.queryloader2.js'
    {{ HTML::script('http://code.jquery.com/jquery-migrate-1.0.0.js'
    {{ HTML::script('js/jquery-ui-1.10.3.custom.min.js'}
    {{ HTML::script('js/modernizr.js'}
    {{ HTML::script('js/jquery.easing.1.3.js'}
    {{ HTML::script('js/waypoints.min.js'}
    {{ HTML::script('js/jquery.stellar.min.js'}
    {{ HTML::script('js/js.js'}
    {{ HTML::script('js/toastr.min.js'}
    {{ HTML::script('js/fancyInput.js'
    {{ HTML::script('js/fancySelect.js'}
    {{ HTML::script('js/niceScroll.js'}
    {{ HTML::script('http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.0.0/moment.min.js'}
  </head>
  <body id="mainContent">

     @section('sidebar')

     @show

     <div class="container">
          @yield('content')
     </div>

  </body>