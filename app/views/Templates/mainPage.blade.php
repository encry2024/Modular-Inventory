<html>
    <head>
       
    </head>

    <title>
        Northstar Inventory
    </title>
    
    <body>
        @yield('header')
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
        
        @yield('bodySection')
        
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
                        $(wrapper).append('<div class="row"><div class="large-12 columns large-centered"><div class="row"><div class="large-10 columns"><input type="text" name="mytext[]" placeholder="Enter device data-field"/></div><a href="#" id="Font" class=" button tiny remove_field radius"><i class="fi-x size-16"></a></div></div></div>'); //add input box
                    }
                });
                
                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); 
                    $(this).parent('div').remove();
                    x--;
                })
            });
        </script>
    </body>
</html>


