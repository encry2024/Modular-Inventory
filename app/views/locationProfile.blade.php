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
		<br><br>
			<li>{{ link_to('Location', 'Return to Location', array('class' => ' tiny radius large-12', 'title' => 'Return to Location')) }}</li>
		</ul>
	</div>
</div>

<div class="large-10 columns">
	<div class="row">
		<div class="large-11 columns">
			<h1>
				{{ $locationName }} - 
				<a href="#" title="Edit location's name." data-reveal-id="editName"><i class="general foundicon-edit size-18"></i></a>
				@if (count($devices) != 0)
					<a href="#" title="Delete location." data-reveal-id="deleteModal" disabled><i class="general foundicon-trash size-18"></i></a>
				@else
					<a href="#" title="Delete location." data-reveal-id="deleteModal"><i class="general foundicon-trash size-18"></i></a>
				@endif
			</h1>
		
 		<div class="large-12 columns">
 			{{ Form::label('', 'Assigned Devices', array('class'=>'font-1 fontSize-8 fontWeight hAlign')) }}
		</div>
		<br><br>
	 	<div class="large-12 columns">
		 	<div class="row">
			 	@foreach ($devices as $device)
			 		@if ($device->deleted_at == '')
			 		<div class="large-2 columns">
				 		{{ Form::label('', $device->item->name . ': ', array('class'=>'font-1 fontSize-8 fontWeight')) }}	
				 	</div>
				 	<label>
				 		{{ link_to('Device/Track/'.$device->id, $device->name, array('class'=>'font-1 fontSize-8 fontWeight') ) }}
					</label>
					@endif
				@endforeach
				</br>
		 	</div>
	 	</div>
	 	</div>
		</br>
		<div class="large-11 columns ">
			<table class="large-12 columns" id="tableTwo">
				<thead>
			   		<tr>
						<th id="headerStyle" class="history-Header-bg table-item-align"> History </th>
					</tr>
				</thead>

				<tbody>
					@foreach ($locationLog as $deviceLog)
						<tr>
							<td>{{ Form::label('', date('F d, Y [ h:i A D ]', strtotime($deviceLog->created_at)). ' - ' . $deviceLog->location->name . ' was '.$deviceLog->action_taken.' with '. $deviceLog->device->name, array('class'=>'font-1 fontSize-6 fontWeight')) }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
<!--MODAL-->

<!--DELETE MODAL-->
<div id="deleteModal" class="reveal-modal small" data-reveal>
	{{ Form::open(array('url' => 'Location/'.$locationId.'/delete')) }}
	<div class="row">
		<div class="large-12 columns">
			<div class="large-12 columns">
				<h1 class="fontSize-3">You are about to Delete this location</h1>
			</div>
			<div class="large-12 columns">
				{{ Form::label('','This location will be permanently deleted.', array( 'class'=>'font-1 radius')) }}
				<br>
				{{ Form::label('', 'Are you sure you want to delete Location '.$locationName.'?', array('class'=>'font-1 radius')) }}
				<br><br>
				{{ Form::submit('Delete' , $attributes = array('class' => 'button tiny large-12 radius', 'name' => 'submit')) }}
			</div>
		</div>
		<a class="close-reveal-modal">&#215;</a>
	</div>
	{{ Form::close() }}
</div>
<!--EDIT MODAL-->
<div id="editName" class="reveal-modal small" data-reveal>
	{{ Form::open(array('url' => 'editLocation')) }}
	<div class="row">
		<div class="large-12 columns">
			<div class="large-12 columns">
				<h1 class="fontSize-3">{{ $locationName }}</h1>
			</div>
			<div class="large-12 columns">
				{{ Form::label('', 'Change Location Name', array( 'class'=>'fontSize-2 fontColor-black' , 'id' => 'modalLbl')) }}
					</br>
					{{ Form::label('locationName', 'Location Name', array('id' => 'Font')) }}
				  	<div class="row">
						<div class="large-12 columns large-centered">
							<div class="row">
								<div class="large-12 columns">
									{{ Form::text('lName', $locationName , array('placeholder' => 'Enter Location Name', 'name'=>'location-'.$locationId)) }}
								</div>
								</a>
							</div>
						</div>
					</div>
					</br>
				{{ Form::submit('Update' , $attributes = array('class' => 'button tiny large-12 radius', 'name' => 'submit')) }}
				</div>
		</div>
		<a class="close-reveal-modal">&#215;</a>
	</div>
	{{ Form::close() }}
</div>
@endsection
