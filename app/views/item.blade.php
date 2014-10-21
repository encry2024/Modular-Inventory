@extends('Templates.Profile')

<?php 
	//declarations
	$ctr = 0;
	$ctr2 = 0;
	$deviceList = $item->device;
	$fields = $item->field;
	$location_name = "";
?>

@section('itemHeader')
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
			<li>{{ link_to('/', 'NORTHSTAR SOLUTIONS INC.', array('class'=>'font-1 fontSize-3')) }}</li>
		</ul>
	</section>
</nav>
@endsection

@section('bdy')
<div class="row">
	<div class="large-10 push-2 columns">
		<h1>{{ $item->name }} Devices</h1>
		
		<div class="row">
			<div class="large-12 columns">
				<table class="large-12 columns tableOne">
		  			<thead>
		   				<tr>
			      			<th id="headerStyle" class="history-Header-bg">Device Name</th>
							<th id="headerStyle" class="history-Header-bg">Availability</th>
							<th id="headerStyle" class="history-Header-bg">Status</th>
							<th class="history-Header-bg">Actions</th>
						</tr>
					</thead>

					<tbody>
					@foreach ($device_location as $devList)
						<tr>
	    					<td>{{ link_to('Device/Track/'.$devList->id , $devList->name, array('title' => "Click to check this device's tracks.", 'id' => $item->id)) }}
							<?php 
								if($devList->location_id != 0 ) {
									echo "<td><a class='label alert ' id='fontSize-Device' >".$devList->availability ." to ".$devList->location->name." </td>";	
								} else {
									if ($devList->status != 'Normal') {
										echo "<td><a class='label alert' id='fontSize-Device' >".$devList->availability."</a></td>";
									} else {
										echo "<td><a class='label success' id='fontSize-Device' >".$devList->availability."</a></td>";
									}
								}
							?>
							</td>
								@if($devList->status != 'Normal')
									<td>{{ Form::label('', $devList->status, array('class' =>'label alert radius fontSourceCode', 'id' => 'fontSize-Device')) }}</td>
								@else
									<td>{{ Form::label('', $devList->status, array('class' =>'label success radius fontSourceCode', 'id' => 'fontSize-Device')) }}</td>
								@endif
							<td>
								<?php
									if($devList->location_id != 0) {
										$locsName = $devList->location->name;
										echo "<a href='#' class='button tiny large-5 radius' onclick='dissociateDeviceProperty($devList->id, \"$devList->name\", \"$locsName\");' data-reveal-id = 'unAssignModal'>Dissociate</a>";
									} else {
										if ($devList->status != 'Normal') {
											echo "<a href='#' class='button tiny large-5 radius' onclick='assignDeviceProperty($devList->id, \"$devList->name\")' data-reveal-id = 'assignModal' disabled>Assign</a>";
										} else {
											echo "<a href='#' class='button tiny large-5 radius' onclick='assignDeviceProperty($devList->id, \"$devList->name\")' data-reveal-id = 'assignModal'>Assign</a>";
										}
									}
								?>
							</td>
						</tr>
					@endforeach
		  			</tbody>
				</table>
			</div>
		</div>
	</div>
    <div class="large-2 pull-10 columns">
	    <div class="panel">
			<ul class="side-nav">
				<li>{{ link_to('adddevice', 'Add', $attributes = array('class' => 'button tiny large-12 radius', 'title' => 'Add a Device', 'data-reveal-id' => 'myModal')) }}</li>
				@if (count($deviceList) == 0)
					<li>{{ link_to('#', 'History', $attributes = array('class' => 'button radius tiny large-12 ', 'title' => 'Track ' . $item->name . 's Update, Date Assigned or Status. ', 'disabled')) }}</li>
				@else
					<li>{{ link_to('Track/'.$item->id, 'History', $attributes = array('class' => 'button radius tiny large-12 ', 'title' => 'Track ' . $item->name . 's Update, Date Assigned or Status.')) }}</li>
				@endif
				<li>{{ link_to('Item/delete/'.$item->id.csrf_token(), 'Delete', $attributes = array('class' => 'button large-12 tiny radius delete_user', 'title' => 'Delete selected Device', 'id' => $item->id .csrf_token() )) }}	</li>
				</br></br></br>
				<li>{{ link_to('', 'Return to Item', array("class"=>"button tiny large-12 radius"))}}</li>
			</ul>
		</div>
    </div>
</div>
<!-- MODALS -->

<!-- ADD DEVICE MODAL -->
<div id="myModal" class="reveal-modal small" data-reveal>
	{{ Form::open(array('url' => 'adddevice')) }}
	<div class="row">
		<div class="large-10 columns">
			<div class="row">
				{{ Form::label('device', 'Device Name', array('id' => 'modalLbl')) }}
			  	{{ Form::text('', '', $attributes = array('class' => 'radius', 'id' => 'textStyle', 'placeholder' => 'Enter the device name', 'name' => 'mydevice')) }}
				</br>
				{{ Form::label('item', 'Informations', array('id' => 'modalLbl')) }}
			  	@foreach ($fields as $devField)
			  		{{ Form::label('itemName', $devField->item_label, array('id' => 'Font')) }}
			  		
			  		@if ($devField->item_label == "Purchased Date")
					{{ Form::text('date', '', array('placeholder' => 'Enter Purchased Date', 'id' => 'dp1', 'name'=>'field-'.$devField->id)) }}
			  		@else
			  			{{ Form::text('','', array('class' => 'radius', 'placeholder' => "Enter device's ". $devField->item_label, 'name' => 'field-'. $devField->id)) }}
			  		@endif

			  	@endforeach
				{{ Form::hidden('itemId', $item->id ) }}
				{{ Form::submit('Add ' . $item->name , $attributes = array('class' => 'button small large-5 radius', 'name' => 'submit')) }}
			</div>
		</div>
		<a class="close-reveal-modal">&#215;</a>
	</div>
	{{ Form::close() }}
</div>

<!--Dissociate MODAL-->
<div id="unAssignModal" class="reveal-modal small" data-reveal>
	{{ Form::open(array('url' => 'unassign')) }}
	<div class="row">
		<div class="large-12 columns">
			<div class="large-12 columns">
				<label id="devFont"></label>
				<h1>{{ Form::label('','', array('name' => 'labelDevice', 'id'=>'deviLabel', 'class' => 'deviceLbl')) }}</h1>
				{{ Form::hidden('idTb', '', array('name' => 'idTb', 'id'=>'id_txtbox' )) }}
			</div>
			<div class="large-12 columns">
				{{ Form::label('', "You are about to dissociate the device stated above from the user.", array('id'=>'Font')) }}
				</br></br>
				{{ Form::label('', "Dissociate to:", array('class' => 'font-1')) }}
				{{ Form::label('','', array('id'=>'location_label', 'class' => 'deviceLbl')) }}
				</br></br></br></br>
				{{ Form::label('', "Are you sure you want to dissociate the device?", array('id'=>'Font')) }}
				</br>
			</div>
			<div class="large-12 columns">
				{{ Form::submit('Dissociate' , $attributes = array('class' => 'button tiny radius large-12', 'name' => 'submit')) }}
			</div>
		</div>
		<a class="close-reveal-modal">&#215;</a>
	</div>
	{{ Form::close() }}
</div>

<!--ASSIGN MODALS-->
<div id="assignModal" class="reveal-modal small" data-reveal>
	{{ Form::open(array('url' => 'assign')) }}
	<div class="row">
		<div class="large-12 columns">
			<div class="large-12 columns">
				<label id="devFont"></label>
				<h1>{{ Form::label('','', array('name' => 'labelDevice', 'id'=>'devLabel', 'class' => 'deviceLbl')) }}</h1>
				{{ Form::hidden('idTb', '', array('name' => 'idTb', 'id'=>'id_textbox' )) }}
				{{ Form::hidden('itemID', $item->id) }}
				{{ Form::label('','Choose below where you want to assign the Device stated above.', array('class'=>'font-1 radius')) }}
				<br></br></br>
				{{ Form::label('', "Location's name", array('id'=>'Font')) }}
				{{ Form::select('locationList', $locations, Input::old('locationList'), array('class'=>'font-1')) }}
				{{ Form::submit('Deploy' , $attributes = array('class' => 'button tiny large-12 radius', 'name' => 'submit')) }}
				</div>
			</div>
		</div>
		<a class="close-reveal-modal">&#215;</a>
	</div>
	{{ Form::close() }}
</div>


<!-- EDIT DEVICE MODAL -->
<div id="editDeviceModal" class="reveal-modal medium" data-reveal>
	{{ Form::open(array('url' => 'updateDevice')) }}
	<div class="large-12 columns large-centered">
		<div class="row">
			<div class="large-12 columns ">
				<div class="large-12 columns">
					<label id="devFont"></label>
					{{ Form::label('','', array('name' => 'deviceName', 'id'=>'device_name', 'class' => 'deviceLbl')) }}
					{{ Form::hidden('', '', array('name' => 'deviceId', 'id'=>'device_id')) }}
					</br>
				</div>
				<div class="large-12 columns">
					{{ Form::label('item', 'Change Information', array('id' => 'modalLbl')) }}
				</br>
				  	@foreach ($fields as $device_field)
				  	{{ Form::label('itemName', $device_field->item_label, array('id' => 'Font')) }}
				  	<div class="row">
						<div class="large-12 columns large-centered">
							<div class="row">
								<div class="large-9 columns">
									{{ Form::text('', $device_field->value , $attributes = array('class'=>'radius center', 'placeholder' => 'Enter devices '. $device_field->item_label, 'name' => 'field-'. $device_field->id)) }}
								</div>
									{{ link_to('Device/delete/'.$device_field->id, 'Delete', array('class' => 'button tiny radius delete_user', 'title' => 'Delete selected Device', 'id' => $device_field->id)) }}
								</a>
							</div>
						</div>
					</div>
				  	@endforeach
				  	<div class="large-11 columns">
					{{ Form::submit('Update' , $attributes = array('class' => 'button tiny large-4 radius', 'name' => 'submit')) }}
				</div>
				</div>
			</div>
		</div>
	</div>
		<a class="close-reveal-modal">&#215;</a>
	{{ Form::close() }}
</div>

<!--SCRIPTS MODAL-->

	<script>

	$('#dp1').pickadate({
		format: 'yyyy-mm-dd',
	});

	function getLocation() {
    document.getElementById("location_ID").value = value;
	}

	function assignDeviceProperty(id, name) {
		document.getElementById("devLabel").innerHTML = name;
		document.getElementById("id_textbox").value = id;
	}

	function dissociateDeviceProperty(id, name, loc_name) {
		document.getElementById("deviLabel").innerHTML = name;
		document.getElementById("id_txtbox").value = id;
		document.getElementById("location_label").innerHTML = loc_name;
	}

	function getDevProperty(id, name) {
		document.getElementById("device_name").innerHTML = name;
		document.getElementById("device_id").value = id;
	}
	$(".delete_user").click(function() {
		if (!confirm("This devices will be permanently deleted and cannot be recovered. Are you sure?")) {
		return false;
		}
	});
	</script>
@endsection