<html>
	<head>
		@yield('deviceHeader')
	</head>

	<title>
		Northstar Inventory
	</title>
	
	<body>
        {{ HTML::script('packages/foundation-5.3.3/js/vendor/jquery.js') }}
        {{ HTML::script('packages/foundation-5.3.3/js/foundation/foundation.js') }}
        {{ HTML::script('packages/foundation-5.3.3/js/foundation/foundation.topbar.js') }}
        {{ HTML::script('packages/foundation-5.3.3/js/foundation/foundation.reveal.js') }}
        {{ HTML::script('packages/foundation-5.3.3/js/foundation/foundation.alert.js') }}
        <!-- Other JS plugins can be included here -->

        {{ HTML::style('packages/foundation-5.3.3/css/normalize.css') }}
        {{ HTML::style('packages/foundation-5.3.3/css/foundation.css') }}
        {{ HTML::style('packages/foundation-icons/foundation-icons.css') }}
        {{ HTML::style('packages/foundation-icons/preview.html') }}
        {{ HTML::style('packages/foundation-icons/foundation-icons.ttf') }}
        {{ HTML::style('main.css') }}
        {{ HTML::script('packages/foundation-5.3.3/js/vendor/modernizr.js') }}

		@yield('deviceBody')

		<script>
		$(document).foundation();
		</script>
 	<style type="text/css">
/*		body {
			background-color: #f4726d;
		}*/
	</style>

	</body>
</html>