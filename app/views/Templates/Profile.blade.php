<html>
	<head>
<<<<<<< HEAD
		@yield('headSection')
=======
		
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
	</head>
	<title>
		Northstar Inventory
	</title>
	
	<body>
<<<<<<< HEAD

=======
		@yield('headSection')
		@yield('itemHeader')
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
        {{ HTML::script('packages/foundation-5.3.3/js/vendor/jquery.js') }}
        {{ HTML::script('packages/foundation-5.3.3/js/foundation/foundation.js') }}
        {{ HTML::script('packages/foundation-5.3.3/js/foundation/foundation.topbar.js') }}
        {{ HTML::script('packages/foundation-5.3.3/js/foundation/foundation.reveal.js') }}
<<<<<<< HEAD
        {{ HTML::script('packages/foundation-5.3.3/js/foundation/foundation.alert.js') }}
=======
         {{ HTML::script('packages/foundation-5.3.3/js/foundation/foundation.alert.js') }}
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
        <!-- Other JS plugins can be included here -->

        {{ HTML::style('packages/foundation-5.3.3/css/normalize.css') }}
        {{ HTML::style('packages/foundation-5.3.3/css/foundation.css') }}
        {{ HTML::style('packages/foundation-icons/foundation-icons.css') }}
        {{ HTML::style('packages/foundation-icons/preview.html') }}
        {{ HTML::style('packages/foundation-icons/foundation-icons.ttf') }}
        {{ HTML::style('main.css') }}
        {{ HTML::script('packages/foundation-5.3.3/js/vendor/modernizr.js') }}
	

<<<<<<< HEAD
				@yield('header')
=======
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
		
		@yield('bdy')


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