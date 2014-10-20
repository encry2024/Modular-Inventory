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

@section('deviceBody')
<div class="row">
	<div class="large-9 push-2 columns">
		<h1> {{ $device->name }} </h1>
			<div class="row">
				<div class="large-12 columns">
					<div class="rows">
						<div class="large-4 columns">
							{{ Form::label('', 'Device Status:', array('class'=>'font-1 fontSize-6 fontWeight')) }}
						</div>
						<div class="large-7 pull-3 columns">
						<!--IF DEVICE STATUS IS NOT NORMAL CHANGE LABEL TO ALERT-->
						@foreach ($dvc as $dev)
							@if ($dev->status != "Normal")
								<label class="label alert font-1 fontSize-6 fontSize-Device radius">{{ $dev->status }}</label>
							@else
								<label class="label Success font-1 fontSize-6 fontSize-Device radius">Normal</label>
							@endif
						@endforeach
						</div>
					</div>
				</div>
				<br>
				<div class="large-12 columns">
					<div class="rows">
						<div class="large-4 columns">
							{{ Form::label('', 'Currently Assigned:', array('class'=>'font-1 fontSize-6 fontWeight')) }}
						</div>
						<div class="large-7 pull-3 columns">
						@foreach ($dvc as $dev)
							@if ($dev->location_id != 0)
								<label class="label alert font-1 fontSize-6 fontSize-Device radius">{{ $dev->location->name }}</label>
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
				</div>
			</div>
		</br>
		</br>
		<table class="large-12 columns" id="tableTwo">
			<thead>
		   		<tr>
					<th>Track Assigned Locations</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($device_location as $devList)
					<tr>
						<td> <b>{{ $devList->created_at }} -</b> <b>{{ $devList->device->name }}</b> was assigned to <b>{{ $devList->location->name }}</b> </td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
    <div class="large-2 pull-10 columns">
	    <div class="panel">
			<ul class="side-nav">
				<li>{{ link_to('', 'Edit', array('onclick' => 'getDevProperty('. $device->id .', "'. $device->name .'")', 'class' => 'button tiny large-12 radius', 'title' => 'Edit a Device', 'data-reveal-id' => 'editDeviceModal')) }}	</li>
					<!--IF DEVICE STATUS IS NOT NORMAL. DISABLE ASSIGN DEVICE-->
					@foreach ($dvc as $dev)
						@if ($dev->status != "Normal")
							<li>{{ link_to('#', 'Assign Device', array("class"=>"button tiny large-12 radius", 'disabled')) }}</li>
						@else
							<li>{{ link_to('', 'Assign Device', array("class"=>"button tiny large-12 radius")) }}</li>
						@endif
					@endforeach
					
					<!--IF DEVICE STATUS IS RETIRED. DISABLE CHANGE STATUS-->
					@if ($dev->status == "Retired")
						<li>{{ link_to('#', 'Change Status', array("class"=>"button tiny large-12 radius", 'onclick' => 'getValue('. $device->id .', "'. $device->name .'")', 'data-reveal-id' => 'updateStatus', 'disabled'))}}</li>
					@else
						@if($dev->location_id == 0)
							<li>{{ link_to('', 'Change Status', array("class"=>"button tiny large-12 radius", 'onclick' => 'getValue('. $device->id .', "'. $device->name .'")', 'data-reveal-id' => 'updateStatus'))}}</li>
						@else
							<li>{{ link_to('#', 'Change Status', array("class"=>"button tiny large-12 radius", 'onclick' => 'getValue('. $device->id .', "'. $device->name .'")', 'data-reveal-id' => 'updateStatus', 'disabled'))}}</li>
							@endif
					@endif
				<li>{{ link_to('Device/delete/'. $device->id.csrf_token(), 'Delete', array('class' => 'button tiny large-12 radius delete_user', 'title' => 'Delete selected Device', 'id' => $device->id . csrf_token())) }}</li>
				</br>
				</br>
				</br>
				</br>
				<li>{{ link_to('Item/'. $devices, 'Return to Devices', $attributes = array('class' => 'button tiny radius large-12', 'title' => 'Return to Devices', 'id'=>$devices  . csrf_token())) }}</li>
			</ul>
		</div>  
    </div>
</div>
<!--Edit Device Modal-->
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
				  	@foreach ($fields as $device_field_info)
						{{ Form::label('itemName', $device_field_info->field->item_label, array('id' => 'Font')) }}
					  	<div class="row">
							<div class="large-12 columns large-centered">
								<div class="row">
									<div class="large-9 columns">
										{{ Form::text('', $device_field_info->value , $attributes = array('class'=>'radius center', 'name' => 'field-'. $device_field_info->id)) }}
									</div>
										{{ link_to('Device/delete/'.$device_field_info->id, 'Delete', array('class' => 'button tiny radius delete_user', 'title' => 'Delete selected Device', 'id' => $device_field_info->id)) }}
									</a>
								</div>
							</div>
						</div>
				  	@endforeach
					{{ Form::submit('Update' , $attributes = array('class' => 'button tiny large-2 radius', 'name' => 'submit')) }}
				</div>
			</div>
		</div>
	</div>
		<a class="close-reveal-modal">&#215;</a>
	{{ Form::close() }}
</div>
<!--CHANGE STATUS MODAL-->
<div id="updateStatus" class="reveal-modal small" data-reveal>
	{{ Form::open(array('url' => 'changestatus')) }}
	<div class="large-12 columns large-centered">
		<div class="row">
			<div class="large-12 columns ">
				<div class="large-12 columns">
					<label id="devFont"></label>
					{{ Form::label('','', array('name' => 'devi_Name', 'id'=>'dev_name', 'class' => 'deviceLbl')) }}
					{{ Form::hidden('', '', array('name' => 'devi_Id', 'id'=>'dev_id')) }}
					</br>
				</div>
				<div class="large-12 columns">
					{{ Form::label('item', 'Change Headset Status', array('id' => 'modalLbl')) }}
				</div>
				</br>
			  	<div class="large-9 columns">
			  	</br>
			  	</br>
			  	{{Form::select('status', array('Normal'=>'Normal','Defective' =>'Defective', 'Retired'=>'Retired'));}}
				{{ Form::submit('Update' , $attributes = array('class' => 'button tiny large-4 radius', 'name' => 'submit')) }}
				</div>
			</div>
		</div>
	</div>
		<a class="close-reveal-modal">&#215;</a>
	{{ Form::close() }}
</div>

@endsection

<script>
	function getDevProperty(id, name) {
		document.getElementById("device_name").innerHTML = name;
		document.getElementById("device_id").value = id;
	}

	function getValue(id, name) {
		document.getElementById("dev_name").innerHTML = name;
		document.getElementById("dev_id").value = id;
	}
</script>
