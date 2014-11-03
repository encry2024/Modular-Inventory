<html>
	<head>

        {{ HTML::style('packages/foundation-5.3.3/css/normalize.css') }}
        {{ HTML::style('packages/foundation-5.3.3/css/foundation.css') }}
        {{ HTML::style('packages/foundation-icons/foundation-icons.css') }}
        {{ HTML::style('packages/foundation-icons/preview.html') }}
        {{ HTML::style('packages/foundation-icons/foundation-icons.ttf') }}
        {{ HTML::style('packages/custom-style/custom-style.css') }}


                <nav class="top-bar" data-topbar role="navigation">
                        <section class="top-bar-section">
                            <!-- Left Nav Section -->
                            <ul class="left">
                                <li class="li-background-none push-1">{{HTML::image('packages/imgs/logo-nsi.png')}}</li>
                                <li class="label-header push-2">Northstar Solutions Inc.</li>
                                </ul>
                        </section>
                </nav>
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


        {{ HTML::script('packages/foundation-5.3.3/js/vendor/modernizr.js') }}
		@yield('bodyLogin')
		<script>
        	$(document).foundation();
        </script>
	</body>
</html>