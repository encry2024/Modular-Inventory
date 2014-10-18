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
<div class="row">
	<div class="large-10 columns large-centered">
		<div class="row">
			<div class="large-12 columns">
<<<<<<< HEAD
				<h3>-Track All Ac-</h3>
=======
				<h3>-Track All {{$itemName}}-</h3>
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
			</div>
		</div>
	</br>
		<div class="row">
			<div class="large-12 columns">
<<<<<<< HEAD
				{{ link_to('Item/'. $item_id, 'Return to ' . $device_name, $attributes = array('class' => 'button tiny radius', 'title' => 'Devices')) }}
=======
				{{ link_to('Item/'. $getInfo->item_id, 'Return to ' . $getInfo->name, $attributes = array('class' => 'button tiny radius', 'title' => 'Devices')) }}
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
			</div>
		</div>

			<table class="large-12 columns" id="tableTwo">
				<thead>
				   	<tr>
						<th>Actions Taken</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($device_locations as $device_location)
						<tr>
							<td>
								<b>{{ $device_location->created_at }} -</b> Device <b> {{ $device_location->device->name }} </b> was assigned to <b> {{ $device_location->location->name }} </b>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection