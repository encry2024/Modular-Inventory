@extends('Templates.device')

@section('deviceHeader')
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
					<li>{{ link_to('changePassword', 'Change Password') }}</li>
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
			@foreach ($dvc as $dev)
				@if ($dev->status != "Normal")
					<li>{{ link_to('#', 'Edit', array('onclick' => 'getDevProperty('. $device->id .', "'. $device->name .'")', 'class' => ' tiny large-12 radius', 'title' => 'Edit Device', 'data-reveal-id' => 'editDeviceModal', 'disabled')) }}	</li>
				@else
					<li>{{ link_to('#', 'Edit', array('onclick' => 'getDevProperty('. $device->id .', "'. $device->name .'")', 'class' => ' tiny large-12 radius ', 'title' => 'Edit Device', 'data-reveal-id' => 'editDeviceModal')) }}	</li>
				@endif
			@endforeach
				<!--IF DEVICE IS NOT NORMAL AND IF DEVICE IS ASSIGNED. DISABLE ASSIGN DEVICE AND DELETE-->
			<?php
			foreach ($dvc as $dev) {
				if($dev->location_id != 0) {
					$locsName = $dev->location->name;
					echo "<li><a href='#' class=' tiny large-12 ' data-reveal-id = 'errorModal' >Delete</a></li>";
					echo "<li><a href='#' class=' tiny large-12 ' onclick='dissociateDeviceProperty($dev->id, \"$dev->name\", \"$locsName\");' data-reveal-id = 'unAssignModal'>Dissociate</a></li>";
				} else {
					echo "<li><a href='#' class='tiny large-12' data-reveal-id = 'deleteModal'>Delete</a></li>";
					if ($dev->status != 'Normal') {
						echo "<li><a href='#' class=' tiny large-12 ' onclick='assignDeviceProperty($dev->id, \"$dev->name\")' data-reveal-id = 'assignModal' disabled>Assign Device</a></li>";
					} else {
						echo "<li><a href='#' class=' tiny large-12 ' onclick='assignDeviceProperty($dev->id, \"$dev->name\")' data-reveal-id = 'assignModal'>Assign Device</a></li>";
					}
				}
			}
			?>
			<!--IF DEVICE STATUS IS RETIRED. DISABLE CHANGE STATUS-->
			@if ($dev->status == "Retired")
				<li>{{ link_to('#', 'Change Status', array("class"=>" tiny large-12 radius", 'onclick' => 'getValue('. $device->id .', "'. $device->name .'")', 'data-reveal-id' => 'updateStatus', 'disabled'))}}</li>
			@else
				@if($dev->location_id == 0)
					<li>{{ link_to('', 'Change Status', array("class"=>" tiny large-12 radius", 'onclick' => 'getValue('. $device->id .', "'. $device->name .'")', 'data-reveal-id' => 'updateStatus'))}}</li>
				@else
					<li>{{ link_to('#', 'Change Status', array("class"=>" tiny large-12 radius", 'onclick' => 'getValue('. $device->id .', "'. $device->name .'")', 'data-reveal-id' => 'warningModal'))}}</li>
				@endif
			@endif
			
			</br></br></br>
			<li>{{ link_to('Item/'. $devices, 'Return to Devices', $attributes = array('class' => ' tiny radius large-12', 'title' => 'Return to Devices', 'id'=>$devices  . csrf_token())) }}</li>
		</ul>
	</div>
</div>

<div class="large-10 columns">
	<div class="row">
		<div class="large-11 columns">
			<h1>{{ $device->name }}</h1>
			<br>
		</div>
		<div class="large-11 columns">
			<div class="row">
				<div class="large-12 columns">
					<div class="row">
						<!--IF DEVICE STATUS IS NOT NORMAL CHANGE LABEL TO ALERT-->
						@foreach ($dvc as $dev)
							<div class="large-3 columns"> 
								{{ Form::label('', 'Device Status:', array('class'=>'font-1 fontWeight')) }}
							</div>
							@if ($dev->status != "Normal")
								<label class="label alert font-1 fontSize-6 fontSize-Device radius">{{ $dev->status }}</label>
								<label class="label alert font-1 fontSize-6 fontSize-Device radius">{{ $dev->comment }}</label>
								
							@else
								<label class="label Success font-1 fontSize-6 fontSize-Device radius">Normal</label>
							@endif
						@endforeach
						<br>
					</div>
				</div>
				<br><br>
				<div class="large-12 columns">
					<div class="row"> 
						@foreach ($dvc as $dev)
							<div class="large-3 columns">
								{{ Form::label('', 'Currently Assigned:', array('class'=>'font-1 fontWeight')) }}
							</div>
							@if ($dev->location_id != 0)
								{{ link_to('/Location/Profile/'.$dev->location_id , $dev->location->name, array('title'=>'Click here to go to locations profile.')) }}
							@else
								@if ($dev->status != 'Normal')
									<label class="label alert font-1 fontSize-6 fontSize-Device radius">{{ $dev->availability }}</label>
								@else 
									<label class="label success font-1 fontSize-6 fontSize-Device radius">{{ $dev->availability }}</label>
								@endif
							@endif
						@endforeach
					</div>
				</div>
				<br><br>
				<div class="large-9 columns large-centered">
				 	<div class="infoLabel">
				 		<h6><span>Device Information</span><h6>
			 		</div>
			 		<br>
			 	</div>
			 	<div class="large-12 columns">
				 	<div class="row">
					 	@foreach ($fields as $device_field_info)
					 		<div class="large-2 columns">
						 		{{ Form::label('', $device_field_info->field->item_label . ': ', array('class'=>'font-1 fontSize-6 fontWeight')) }}	
						 	</div>
						 	{{ Form::label('', $device_field_info->value, array('class'=>'font-1 fontSize-6 fontWeight') ) }}
						@endforeach
				 	</div>
			 	</div>
			</div>
			<br>
			@if ($alert = Session::get('message'))
				<div data-alert class="alert-box success radius">
					{{ $alert }}
					<a href="#" class="close">&times;</a>
				</div>
			@endif
			<br>
		</div>
		</br>
		<div class="large-11 columns">
			<table class="large-12 columns" id="tableTwo">
				<thead>
			   		<tr>
						<th id="headerStyle" class="history-Header-bg table-item-align">Track Assigned Locations</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($device_location as $devList)
						<tr>
							<td>{{ Form::label('', date('F d, Y [ h:i A D ]', strtotime($devList->created_at)). ' -' . $devList->device->name . ' was '.$devList->action_taken.' to '. $devList->location->name, array('class'=>'font-1 fontSize-6 fontWeight')) }}</td>
						</tr>
					@endforeach
				</tbody>
				{{ $device_location->links() }}
			</table>
		</div>
	</div>
</div>
<!--MODAL-->

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
				<select name="locationList">
					@foreach ($locations as $loc)
						<option value= {{ $loc->id }}>{{ $loc->name }}</option>
					@endforeach
				</select>
				{{ Form::submit('Deploy' , $attributes = array('class' => 'button tiny large-12 radius', 'name' => 'submit')) }}
				</div>
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

<!--ERROR MESSAGE MODAL-->
<div id="errorModal" class="reveal-modal small" data-reveal>
	<div class="row">
		<div class="large-12 columns">
			<div class="large-12 columns">
				<h1 class="fontSize-3 error-message">ERROR!</h1>
			</div>

			<div class="large-12 columns">
				{{ Form::label('', "You cannot delete this item.", array( 'class'=>'font-1 ')) }}
				<br>
				{{ Form::label('', 'Someone is still using this Device. This device must be return first before you can delete this.', array('class'=>'font-1 font-6')) }}
			</div>
		</div>
		<a class="close-reveal-modal">&#215;</a>
	</div>
</div>


<!--ERROR MESSAGE MODAL-->
<div id="warningModal" class="reveal-modal small" data-reveal>
	<div class="row">
		<div class="large-12 columns">
			<div class="large-12 columns">
				<h1 class="fontSize-3 error-message">ERROR!</h1>
			</div>

			<div class="large-12 columns">
				{{ Form::label('', "You cannot Change this Device's status while its on use.", array( 'class'=>'font-1 ')) }}
				<br>
				{{ Form::label('', 'This device must be returned first before you can edit this.', array('class'=>'font-1 font-6')) }}
			</div>
		</div>
		<a class="close-reveal-modal">&#215;</a>
	</div>
</div>


<!--DELETE MODAL-->
<div id="deleteModal" class="reveal-modal small" data-reveal>
	{{ Form::open(array('url' => 'Device/'.$device_id.'/delete')) }}
	<div class="row">
		<div class="large-12 columns">
			<div class="large-12 columns">
				<h1 class="fontSize-3">Delete Device - {{ $device_name }} </h1>
			</div>

			<div class="large-12 columns">
				{{ Form::label('','This Device will be permanently deleted.', array( 'class'=>'fontSize-6 fontColor-black fontWeight' , 'id' => 'modalLbl')) }}
				<br>
				{{ Form::label('', 'Are you sure you want to delete Device '.$device_name.'?', array( 'class'=>'fontSize-6 fontColor-black fontWeight' , 'id' => 'modalLbl')) }}
				<br>
				{{ Form::submit('Delete' , $attributes = array('class' => 'button tiny large-12 radius', 'name' => 'submit')) }}
			</div>
		</div>
		<a class="close-reveal-modal">&#215;</a>
	</div>
	{{ Form::close() }}
</div>

<!--Edit Device Modal-->
<div id="editDeviceModal" class="reveal-modal small" data-reveal>
	{{ Form::open(array('url' => 'updateDevice')) }}
	<div class="large-12 columns large-centered">
		<div class="row">
			<div class="large-12 columns ">
				<div class="large-12 columns">
					<label id="devFont"></label>
						<h1>{{ Form::label('',' - Edit', array('name' => 'deviceName', 'id'=>'device_name', 'class' => 'deviceLbl')) }}</h1>
						{{ Form::hidden('', '', array('name' => 'deviceId', 'id'=>'device_id')) }}
					</br>
				</div>
				<div class="large-12 columns">
				{{ Form::label('item', 'Change Information', array('id' => 'modalLbl')) }}
				</br></br>
				@foreach ($fields as $device_field_info)
					{{ Form::label('itemName', $device_field_info->field->item_label, array('id' => 'Font')) }}
				  	<div class="row">
						<div class="large-12 columns large-centered">
							<div class="row">
								<div class="large-12 columns">
								@if ($device_field_info->field->item_label == "Purchased Date")
									{{ Form::text('date', $device_field_info->value , array('placeholder' => 'Enter Purchased Date', 'id' => 'dp1', 'name'=>'field-'.$device_field_info->id)) }}
						  		@else
						  			{{ Form::text('', $device_field_info->value , $attributes = array('class'=>'radius center', 'name' => 'field-'. $device_field_info->id)) }}
						  		@endif
								</div>
								</a>
							</div>
						</div>
					</div>
				@endforeach
				</br>
				{{ Form::submit('Update' , $attributes = array('class' => 'button tiny large-12 radius', 'name' => 'submit')) }}
				</div>
			</div>
		</div>
	</div>
	<a class="close-reveal-modal">&#215;</a>
	{{ Form::close() }}
</div>

<!--CHANGE STATUS MODAL-->
<div id="updateStatus" class="reveal-modal medium" data-reveal>
	{{ Form::open(array('url' => 'changestatus')) }}
	<div class="large-12 columns large-centered">
		<div class="row">
			<div class="large-12 columns ">
				<div class="large-12 columns">
					<label id="devFont"></label>
					<h1>{{ Form::label('','', array('name' => 'devi_Name', 'id'=>'dev_name', 'class' => 'deviceLbl')) }}</h1>
						{{ Form::hidden('', '', array('name' => 'devi_Id', 'id'=>'dev_id')) }}
					</br>
				</div>
				<div class="large-12 columns">
					{{ Form::label('item', 'Change Device Status', array('id' => 'modalLbl')) }}
				</div>
				</br>
			  	<div class="large-12 columns">
			  	</br></br>
			  	{{ Form::select('status', array('Normal'=>'Normal','Defective' =>'Defective', 'Retired'=>'Retired')) }}
			  	{{ Form::label('Comment') }}
			  	{{ Form::textarea('commentArea','') }}
				{{ Form::submit('Update' , $attributes = array('class' => 'button tiny large-4 radius')) }}
				</div>
			</div>
		</div>
	</div>
	<a class="close-reveal-modal">&#215;</a>
	{{ Form::close() }}
</div>

<!--SCRIPTS-->
<script>
	$('#dp1').pickadate({
		format: 'yyyy-mmmm-dd',
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

	function getValue(id, name) {
		document.getElementById("dev_name").innerHTML = name;
		document.getElementById("dev_id").value = id;
	}
</script>
@endsection
