<html>
	<head>
		@yield('deviceHeader')
		{{ HTML::style('packages/foundation-5.3.3/css/normalize.css') }}
		{{ HTML::style('packages/foundation-5.3.3/css/foundation.css') }}
		{{ HTML::style('packages/foundation-icons/foundation-icons.css') }}
		{{ HTML::style('packages/foundation-icons/preview.html') }}
		{{ HTML::style('packages/foundation-icons/foundation-icons.ttf') }}
		{{ HTML::style('assets/css/foundation-datepicker.css') }}
		{{ HTML::style('main.css') }}
		{{ HTML::style('assets/css/main.css') }}
		{{ HTML::style('assets/css/classic.css') }}
		{{ HTML::style('assets/css/classic.date.css') }}
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

		<script>
			$(function(){
			    $(document).foundation();    
			})
		</script>

		@yield('deviceBody')
	</body>
</html>