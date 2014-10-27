
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>
		Northstar Inventory
	</title>
		{{ HTML::style('packages/foundation-5.3.3/css/normalize.css') }}
		{{ HTML::style('packages/foundation-5.3.3/css/foundation.css') }}
		{{ HTML::style('packages/foundation-icons/foundation-icons.css') }}
		{{ HTML::style('packages/foundation-icons/preview.html') }}
		{{ HTML::style('packages/foundation-icons/foundation-icons.ttf') }}
		{{ HTML::style('assets/css/foundation-datepicker.css') }}
		{{ HTML::style('main.css') }}
		{{ HTML::style('assets/css/main.css') }}
		{{ HTML::style('assets/css/classic.date.css') }}
	</head>
	
	<body>
		{{ HTML::script('packages/jqueries/jquery-1.11.1.min.js') }}
		
		{{ HTML::script('packages/foundation-5.3.3/js/vendor/jquery.js') }}
		{{ HTML::script('packages/foundation-5.3.3/js/foundation/foundation.js') }}
		{{ HTML::script('packages/foundation-5.3.3/js/foundation/foundation.topbar.js') }}
		{{ HTML::script('packages/foundation-5.3.3/js/foundation/foundation.reveal.js') }}
		{{ HTML::script('packages/foundation-5.3.3/js/foundation/foundation.alert.js') }}
		{{ HTML::script('packages/foundation-5.3.3/js/vendor/modernizr.js') }}
		{{ HTML::script('assets/js/picker.js') }}
		{{ HTML::script('assets/js/picker.date.js') }}
		{{ HTML::script('packages/jqueries/jquery.dataTables.min.js') }}
        <!-- Other JS plugins can be included here -->
		<script>
		
			$(function(){
			    $(document).foundation();    
			})
			$(document).ready(function() {
				    // Setup - add a text input to each footer cell
				    $('#tableSearch tfoot th').each( function () {
				        var title = $('#tableSearch thead th').eq( $(this).index() ).text();
				        $(this).html( '' );
				    } );
				 
				    // DataTable
				    var table = $('#tableSearch').DataTable();
				 
				    // Apply the search
				    table.columns().eq( 0 ).each( function ( colIdx ) {
				        $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
				            table
				                .column( colIdx )
				                .search( this.value )
				                .draw();
				        } );
			    	} );
		} );
		</script>

		@yield('headSection')
		@yield('itemHeader')
		@yield('bdy')

	</body>
</html>