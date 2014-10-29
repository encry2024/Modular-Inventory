<html>
	<head>
		@yield('deviceHeader')

		{{ HTML::style('packages/foundation-5.3.3/css/normalize.css') }}
		{{ HTML::style('packages/foundation-5.3.3/css/foundation.css') }}
		{{ HTML::style('packages/foundation-icons/foundation-icons.css') }}
		{{ HTML::style('packages/foundation-icons/preview.html') }}
		{{ HTML::style('packages/foundation-icons/foundation-icons.ttf') }}
		{{ HTML::style('packages/foundation-icons-general/stylesheets/general_foundicons.css') }}
		{{ HTML::style('assets/css/foundation-datepicker.css') }}
		{{ HTML::style('main.css') }}
		{{ HTML::style('assets/css/main.css') }}
		{{ HTML::style('assets/css/classic.date.css') }}
		{{ HTML::script('packages/jqueries/jquery.dataTables.min.js') }}
	</head>

	<title>
		Northstar Inventory
	</title>
	
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
		{{ HTML::script('packages/jqueries/tablePaginate.dataTables.min.js') }}

		<script>
			$(function(){
			    $(document).foundation();    
			})
			$(document).ready(function() {
				    // Setup - add a text input to each footer cell
				    // DataTable
				    var table = $('#tableSearch1').DataTable();
				 
				    // Apply the search
				    table.columns().eq( 0 ).each( function ( colIdx ) {
				        $( 'input', table.column( colIdx ) ).on( 'keyup change', function () {
				            table
				                .column( colIdx )
				                .search( this.value )
				                .draw();
				        } );
			    	} );
		} );

		$(document).ready(function() {
				// Setup - add a text input to each footer cell
				    // DataTable
				    var table = $('#tableSearch2').DataTable();
				 
				    // Apply the search
				    table.columns().eq( 0 ).each( function ( colIdx ) {
				        $( 'input', table.column( colIdx ) ).on( 'keyup change', function () {
				            table
				                .column( colIdx )
				                .search( this.value )
				                .draw();
				        } );
			    	} );
		} );

		$(document).ready(function() {
				// Setup - add a text input to each footer cell
				    // DataTable
				    var table = $('#tableSearch3').DataTable();
				 
				    // Apply the search
				    table.columns().eq( 0 ).each( function ( colIdx ) {
				        $( 'input', table.column( colIdx ) ).on( 'keyup change', function () {
				            table
				                .column( colIdx )
				                .search( this.value )
				                .draw();
				        } );
			    	} );
		} );

		$(document).ready(function() {
				// Setup - add a text input to each footer cell
				    // DataTable
				    var table = $('#tableSearch4').DataTable();
				 
				    // Apply the search
				    table.columns().eq( 0 ).each( function ( colIdx ) {
				        $( 'input', table.column( colIdx ) ).on( 'keyup change', function () {
				            table
				                .column( colIdx )
				                .search( this.value )
				                .draw();
				        } );
			    	} );
		} );
		</script>

		@yield('deviceBody')
	</body>
</html>