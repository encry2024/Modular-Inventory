@extends('Templates.Profile')

<?php 
	//declarations
	$ctr = 0;
	$ctr2 = 0;
	$deviceList = $item->device;
	$fields = $item->field;
	$location_name = "";
?>

@section('header')
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
<div class="large-11 columns large-centered">
	<h1 class="font">{{ $item->name }} Devices</h1>

{{ Form::label('','',array('id'=>'location_ID')) }}
</br>
<!--MAIN PAGE DESIGN-->
<div class="large-10 columns large-centered">
	<div class="row">
			<!--DEVICE MENU BUTTON-->
			<div class="row">
				<div class="large-12 columns">
					<div class="row">
						<div class="large-6 columns">
							{{ link_to('adddevice', 'Add', $attributes = array('class' => 'button tiny large-3 radius', 'title' => 'Add a Device', 'data-reveal-id' => 'myModal')) }}
							{{ link_to('Track/'.$item->id, 'History', $attributes = array('class' => 'button radius tiny large-3 ', 'title' => 'Track ' . $item->name . 's Update, Date Assigned or Status. ')) }}
							{{ link_to('/', 'Home', $attributes = array('class' => 'button radius tiny large-3 ', 'title' => 'Return Home')) }}
							@if ($notification = Session::get('message'))
								<div data-alert class="alert-box success ">
									{{ $notification }}
									<a href="#" class="close">&times;</a>
								</div>
							@endif
						</div>
					</div>
				</div>
			</div>
			<!--DEVICE TABLE-->
			<div class="row">
				@if($errors->has()) 
					@foreach($errors->all() as $message)
						<span class="error small-8 columns small-centered">{{ $message }}</span>
					@endforeach
				@endif
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
									if("0" < $devList->location_id ) {
											echo "<td><a class='label alert' id='fontSize-Device' >".$devList->availability ." to ".$devList->location->name." </td>";	
									} else {
										echo "<td><a class='label success' id='fontSize-Device' >".$devList->availability."</a></td>";
									}
								?>
								<td>{{ Form::label('', $devList->status, array('class' =>'label success radius', 'id' => 'fontSize-Device')) }}</a></td>
								<td>
									<?php
										if("0" < $devList->location_id ) {
											$locsName = $devList->location->name;
											echo "<a href='#' class='button tiny large-5 radius' onclick='dissociateDeviceProperty($devList->id, \"$devList->name\", \"$locsName\");' data-reveal-id = 'unAssignModal'>Dissociate</a>";
									} else {
											echo "<a href='#' class='button tiny large-5 radius' onclick='assignDeviceProperty($devList->id, \"$devList->name\")' data-reveal-id = 'assignModal'>Assign</a>";
									}
									?>
									{{ link_to('', 'Edit', array('onclick' => 'getDevProperty('. $devList->id .', "'. $devList->name .'")', 'class' => 'button tiny large-0 radius', 'title' => 'Edit a Device', 'data-reveal-id' => 'editDeviceModal')) }}	
									{{ link_to('Device/delete/'. $devList->id.csrf_token(), 'Delete', array('class' => 'button tiny radius delete_user', 'title' => 'Delete selected Device', 'id' => $devList->id . csrf_token())) }}
								</td>
							</tr>
						@endforeach
			  			</tbody>
					</table>	
				</div>
			</div>
		</div>
	</div>
</div>

<!-- MODALS -->

<!-- ADD DEVICE MODAL -->
<div id="myModal" class="reveal-modal small" data-reveal>
	{{ Form::open(array('url' => 'adddevice')) }}
	<div class="row">
		<div class="large-7 columns">
			<div class="row">
				{{ Form::label('device', 'Device Name', array('id' => 'modalLbl')) }}
			  	{{ Form::text('', '', $attributes = array('class' => 'radius', 'id' => 'textStyle', 'placeholder' => 'Enter the device name', 'name' => 'mydevice')) }}
				</br>
				{{ Form::label('item', 'Informations', array('id' => 'modalLbl')) }}

			  	@foreach ($fields as $devField)
			  		{{ Form::label('itemName', $devField->item_label, array('id' => 'Font')) }}
			  		{{ Form::text('','', array('class' => 'radius', 'placeholder' => "Enter device's ". $devField->item_label, 'name' => 'field-'. $devField->id)) }}
			  	@endforeach

			{{ Form::hidden('itemId', $item->id . csrf_token() ) }}
			{{ Form::submit('Add ' . $item->name , $attributes = array('class' => 'button small large-4 radius', 'name' => 'submit')) }}
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
		<div class="large-7 columns">

			<div class="large-12 columns">
					<label id="devFont"></label>
					{{ Form::label('','', array('name' => 'labelDevice', 'id'=>'deviLabel', 'class' => 'deviceLbl')) }}
					{{ Form::hidden('idTb', '', array('name' => 'idTb', 'id'=>'id_txtbox' )) }}
					</br>
			</div>
			<div class="large-12 columns">
				{{ Form::label('', "You are about to dissociate the device stated above from the user.", array('id'=>'Font')) }}
				</br>
				{{ Form::label('', "Dissociate to:", array('class' => 'font-1')) }}
				{{ Form::label('','', array('id'=>'location_label', 'class' => 'deviceLbl')) }}
				</br>
				</br>
				</br>
				{{ Form::label('', "Are you sure you want to dissociate the device?", array('id'=>'Font')) }}
				</br>
				
			</div>

			</div>

			<div class="large-12 columns">
				<div class="large-12 columns">
					{{ Form::submit('Dissociate' , $attributes = array('class' => 'button tiny radius', 'name' => 'submit')) }}
				</div>
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
		<div class="large-7 columns">

			<div class="large-12 columns">
				<label id="devFont"></label>
				{{ Form::label('','', array('name' => 'labelDevice', 'id'=>'devLabel', 'class' => 'deviceLbl')) }}
				<br>
				<br>
				{{ Form::hidden('idTb', '', array('name' => 'idTb', 'id'=>'id_textbox' )) }}
				{{ Form::hidden('itemID', $item->id) }}
				{{ Form::label('','Choose below where you want to assign the Device stated above.', array('class'=>'font-1 radius')) }}
				<br>
				{{ Form::label('', "Location's name", array('id'=>'Font')) }}
				{{ Form::select('locationList', $locations, Input::old('locationList'), array('class'=>'font-1')) }}
				{{ Form::submit('Deploy' , $attributes = array('onclick'=>'getLocation(id)', 'class' => 'button tiny large-4 radius', 'name' => 'submit')) }}
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

		$(".delete_user").click(function(){
			if (!confirm("This devices will be permanently deleted and cannot be recovered. Are you sure?")) {
			return false;
			}
		});
	</script>
@endsection