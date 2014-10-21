<html>
	<head>
	</head>
	<title>
		Northstar Inventory
	</title>
	@yield('registerBody')
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
	</body>
</html>