<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" ng-app>
    <title>@yield('title', 'Time Clock')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Bootstrap --}}
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    {{ HTML::style('packages/awesome/css/font-awesome.css', array('media' => 'screen')) }}
    {{ HTML::style('packages/bootstrap/css/bootstrap.css', array('media' => 'screen')) }}
    {{ HTML::style('css/main.css', array('media' => 'screen')) }}
    {{ HTML::style('packages/clock/css/flipclock.css', array('media' => 'screen')) }}

    {{ HTML::style('css/fancyInput.css') }}
    {{ HTML::style('css/StyleApp.css') }}
    {{-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries --}}
  </head>
  <body>

     <div class="container">
          @yield('content')
     </div>


     {{-- jQuery (necessary for Bootstrap's JavaScript plugins) --}}
    <script src="//code.jquery.com/jquery.js"></script>
    {{-- Include all compiled plugins (below), or include individual files as needed --}}
    {{ HTML::script('packages/bootstrap/js/bootstrap.min.js') }}   
    <!-- COUNTER -->   
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!-- load angular -->
   <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.5/angular.min.js"></script>
    {{ HTML::script('packages/clock/js/base.js') }}
    {{ HTML::script('js/clock.js') }}
    {{ HTML::script('packages/clock/js/flipclock.js') }}
    {{ HTML::script('packages/clock/js/counter.js') }}
    {{ HTML::script('packages/clock/js/hourlycounter.js') }}
    {{ HTML::script('packages/clock/js/minutecounter.js') }}    
    {{ HTML::script('packages/clock/js/twentyfourhourclock.js') }}
    {{ HTML::script('packages/clock/js/twelvehourclock.js') }} 
    <!-- COUNTER -->      
    {{-- jquery UI --}}
    {{ HTML::style('css/jquery-ui.css') }}
    {{ HTML::script('js/jquery-1.9.1.js') }}
    {{ HTML::script('js/jquery-ui.js') }}
    {{ HTML::script('js/app.js') }}
    <!--[if lt IE 9]>
        {{ HTML::script('assets/js/html5shiv.js') }}
        {{ HTML::script('assets/js/respond.min.js') }}
    <![endif]-->
  </body>
</html>