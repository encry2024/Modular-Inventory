<html>
	<head>
		@yield('headSection')
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
        {{ HTML::style('packages/foundation_icons_general_enclosed/stylesheets/general_enclosed_foundicons.css') }}
        <!-- Other JS plugins can be included here -->

        {{ HTML::style('packages/foundation-5.3.3/css/normalize.css') }}
        {{ HTML::style('packages/foundation-5.3.3/css/foundation.css') }}
        {{ HTML::style('packages/foundation-icons/foundation-icons.css') }}
        {{ HTML::style('packages/foundation-icons/preview.html') }}
        {{ HTML::style('packages/foundation-icons/foundation-icons.ttf') }}
        {{ HTML::style('main.css') }}
        {{ HTML::style('packages/foundation_icons_general_enclosed/stylesheets/general_enclosed_foundicons.ttf') }}
        {{ HTML::script('packages/foundation-5.3.3/js/vendor/modernizr.js') }}

		@yield('itemBody')

		<script>
		$(document).foundation();
		</script>

		<script type="text/javascript">
            $(document).ready(function() {
                var max_fields      = 10; //maximum input boxes allowed
                var wrapper         = $(".input_fields_wrap"); //Fields wrapper
                var add_button      = $(".add_field_button"); //Add button ID
                
                var x = 1; //initlal text box count
                $(add_button).click(function(e){ //on add input button click
                    e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div class="row"><div class="large-12 columns large-centered"><div class="row"><div class="large-10 columns"><input type="text" class="inputField" name="mytext[]" placeholder="Enter Item data-field"/></div><a href="#" id="Font" class=" button tiny remove_field radius">Delete</a></div></div></div>'); //add input box
                    }
                });
                
                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); $(this).parent('div').remove(); x--;
                })
            });
        </script>
 	<style type="text/css">
/*		body {
			background-color: #f4726d;
		}*/
	</style>

	</body>
</html>