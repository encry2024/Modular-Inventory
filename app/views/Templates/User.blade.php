<html>
	<head>
		@section('headSection')

		@endsection
	</head>

	<title>
		Northstar Inventory
	</title>
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
		@yield('body')
	<style type="text/css">
		body {
			background-color: #4e2700;
		}
	</style>

	</body>
</html>