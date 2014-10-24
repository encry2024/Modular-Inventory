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
			<li>{{ link_to('/', 'Northstar Solutions Inc.', array('class'=>'font-1 fontSize-5')) }}</li>
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
				<h3>-Track All {{$itemName}}-</h3>
			</div>
		</div>
	</br>
		<div class="row">
			<div class="large-12 columns">
				{{ link_to('Item/'. $itemId, 'Return to ' . $itemName, $attributes = array('class' => 'button tiny radius', 'title' => 'Devices')) }}
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
						@foreach ($device_location->devicelog as $dl)
							<tr>
								<td>
									{{ Form::label('', date('F d, Y [ h:i A D ]', strtotime($dl->created_at)). ' -' . $dl->device->name . ' was '.$dl->action_taken.' to '. $dl->location->name, array('class'=>'font-1 fontSize-6 fontWeight')) }}
								</td>
							</tr>
						@endforeach
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection