
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
        {{ HTML::style('packages/foundation-5.3.3/css/normalize.css') }}
        {{ HTML::style('packages/foundation-5.3.3/css/foundation.css') }}
        {{ HTML::style('packages/foundation-icons/foundation-icons.css') }}
        {{ HTML::style('packages/foundation-icons/preview.html') }}
        {{ HTML::style('packages/foundation-icons/foundation-icons.ttf') }}
        {{ HTML::style('main.css') }}
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
		{{ HTML::script('packages/foundation-5.3.3/js/vendor/modernizr.js') }}
		{{ HTML::script('assets/js/picker.js') }}
		{{ HTML::script('assets/js/picker.date.js') }}

        <!-- Other JS plugins can be included here -->
		<script>
			$(function(){
			    $(document).foundation();    
			})
		</script>

		@yield('headSection')
		@yield('itemHeader')
		@yield('bdy')
	</body>
</html>