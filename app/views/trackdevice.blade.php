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
</br>
<div class=" large-10 columns large-centered">
	</br>
	<div class="row">
		<div class="large-5 columns">
			{{ link_to('Item/'. $devices, 'Return to Devices', $attributes = array('class' => 'button tiny radius', 'title' => 'Return Home', 'id'=>$devices  . csrf_token())) }}
		</div>
	</div>
	</br>
	<div class="row">
		<div class="large-12 columns">
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
	</div>
</div>
@endsection