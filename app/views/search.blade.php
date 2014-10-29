@extends('Templates.device')

@section('deviceHeader')
<?php 
	//KEEP VALUE IN DATE TEXTBOX
	if(isset($_POST['dateTb']) != '') {
		$date_entry = $_POST['dateTb'];
	} else {
		$date_entry = '';
	}

	//KEEP VALUE IN SEARCH TEXTBOX
	if(isset($_POST['searchTb']) != '') {
	$entry = $_POST['searchTb'];
	} else {
		$entry = '';
	}
?>
<nav class="top-bar" data-topbar role="navigation">
	<ul class="title-area">
		<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
		<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
	</ul>
	<section class="top-bar-section">
		<!-- Right Nav Section -->
		<ul class="right">
			<li class="has-dropdown"><a href="">Welcome, {{ Auth::user()->firstname }}</a><a href="#"></a>
				<ul class="dropdown">
				<li class="divider"></li>
					<li>{{ link_to('logout','Logout') }} </li>
					<li class="active"><a href="#">Change Password</a></li>
				</ul>
			</li>
		</ul>
    		<!-- Left Nav Section -->
		<ul class="left">
			<li>{{ link_to('/', 'Northstar Solutions Inc.', array('class'=>'font-1 fontSize-5')) }}</li>
		</ul>
	</section>
</nav>
@endsection

@section('deviceBody')

<div class="large-2 small-12 columns">
	<div class="sidebar">
		<ul class="side-nav">
			<li>{{ link_to('', 'Back to Main Page', array("class"=>"tiny large-12 radius"))}}</li>
		</ul>
	</div>
</div>
<div class="large-10 columns">
	<div class="row">
		<div class="large-12 columns">
			<h1>Search All - 
			<a href="Search" title="Fetch all Records." data-reveal-id="editName"><i class="general foundicon-refresh size-16"></i></a>
			</h1>
		</div>
	</div>
	{{ Form::open(array('url' => 'getSearch')) }}
		<div class="row">
			<div class="large-6 columns">
				{{ Form::label('', 'Search by Name: ') }}
				<div class="row">
					<div class="large-10 columns">
						{{ Form::text('searchTb', $entry, array('name'=>'searchTb', 'placeholder'=>'Device name / Item name / Location name / Record', 'class'=>'radius')) }}	
					</div>
				</div>
			</div>
			
			<div class="large-6 columns">
				{{ Form::label('', 'Date Filter: ') }}
				<div class="row">
					<div class="large-10 columns">
							{{ Form::text('dateTb',  $date_entry, array('name'=>'dateTb', 'id'=>'dp1' , 'placeholder'=>'Date Filter', 'class'=>'radius')) }}
					</div>
					{{ Form::submit('Search', array('class'=>' button tiny radius warning font-1 fontSize-6')) }}
				</div>
			</div>
		</div>
	{{ Form::close() }}

	<div class="row">
		<div class="large-12 small-12 columns" >
		<!--DEVICE TABLE-->
		<br>
			<h1 class="separator"></h1>
			<label class="h1Custom font"> {{ count($devices) }} Record(s) found in Devices</label>
			<br>

			<table class="display" id="tableSearch3" cellspacing="0" width="100%">
	  			<thead>
	   				<tr>
	   					<th class="textWidth2">Date Added</th>
		      			<th>Devices</th>
					</tr>
				</thead>

				<tbody>
				@foreach ($devices as $device)
					<tr>
						<td>
							{{ Form::label('' , date('F d, Y [ h:i A D ]', strtotime($device->created_at)), array('class'=>'font-1 fontSize-6 fontWeight large-5')) }}
						</td>
						<td>
							{{ link_to('Device/Track/'.$device->id, $device->name, array( 'class'=>'font-1 fontSize-6 fontWeight' ,'title' => "Click to check ".$device->name." Informations.")) }}
						</td>
					</tr>
				@endforeach
	  			</tbody>
			</table>

			<!--ITEM TABLE-->
			<br>
			<label class="h1Custom font success"> {{ count($items) }} Record(s) found in Items </label>
			<br>

			<table class="display" id="tableSearch2" cellspacing="0" width="100%">
	  			<thead>
	   				<tr>
	   					<th class="textWidth2">Date Added</th>
	   					<th width="100%">Items</th>
					</tr>
				</thead>

				<tbody>
				@foreach ($items as $item)
					<tr>
						<td>
							{{ Form::label('' , date('F d, Y [ h:i A D ]', strtotime($item->created_at)), array('class'=>'font-1 fontSize-6 fontWeight large-5')) }}
						</td>
						<td>
							{{ link_to('Item/'. $item->id , $item->name, array('class'=>'font-1 fontSize-6 fontWeight textWidth', 'title' => "Go to Item's Profile", 'name' => 'item-' . $item->id)) }}
						</td>
					</tr>
				@endforeach
	  			</tbody>
			</table>

			<!--LOCATION-->

			<br>
			
			<label class="h1Custom font success"> {{ count($locations) }} Record(s) found in Location </label>
			<br>

			<table class="display" id="tableSearch4" width="100%">
	  			<thead>
	   				<tr>
	   					<th class="textWidth2">Date Added</th>
		      			<th>Locations</th>
					</tr>
				</thead>

				<tbody>
				@foreach ($locations as $locations)
					<tr>
						<td>
							{{ Form::label('' , date('F d, Y [ h:i A D ]', strtotime($locations->created_at)), array('class'=>'font-1 fontSize-6 fontWeight large-5')) }}
						</td>
						<td>
							{{ link_to('Location/Profile/'.$locations->id, $locations->name, array('class'=>'font-1 fontSize-6 fontWeight')) }}
						</td>
					</tr>
				@endforeach
	  			</tbody>
			</table>

			<!--HISTORY-->

			<br>
			
			<label class="h1Custom font success"> {{ count($audit) }} Record(s) found in History </label>
			<br>

			<table class="display" id="tableSearch1" cellspacing="0" width="100%">
	  			<thead>
	   				<tr>
	   					<th class="textWidth1">Date Recorded</th>
		      			<th>History</th>
					</tr>
				</thead>

				<tbody>
				@foreach ($audit as $audits)
					<tr>
						<td>
							{{ Form::label('', date('F d, Y [ h:i A D ]', strtotime($audits->created_at)), array('class'=>'font-1 fontSize-6 fontWeight')) }}
						</td>
						<td>
							{{ Form::label('', $audits->history, array('class'=>'font-1 fontSize-6 fontWeight')) }}
						</td>
					</tr>
				@endforeach
	  			</tbody>
			</table>
		</div>
	</div>
</div>

<!--SCRIPTS-->
<script>
	$('#dp1').pickadate({
		format: 'm/d/yyyy',
	});
</script>
@endsection