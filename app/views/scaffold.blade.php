<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
	    {{ HTML::style('autocomplete/css/jquery-ui.css') }}
	    <style>
			table form { margin-bottom: 0; }
			.error { color: red; font-style: italic; }
			body { padding-top: 20px; }
			.ui-autocomplete {z-index: 100;}
		</style>
	</head>

	<body>

		<div class="container">
			@if (Session::has('message'))
				<div class="flash alert">
					<p>{{ Session::get('message') }}</p>
				</div>
			@endif

			@yield('main')
		</div>
		{{ HTML::script('autocomplete/js/jquery-1.9.1.js') }}
        {{ HTML::script('autocomplete/js/jquery-ui.js') }}
        {{ HTML::script('autocomplete/js/app.js') }}
	</body>

</html>