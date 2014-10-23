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
			<li>{{ link_to('/', 'NORTHSTAR SOLUTIONS INC.', array('class'=>'font-1 fontSize-5')) }}</li>
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
				<h3>-Track {{ $item->name }} Assignments-</h3>
			</div>
		</div>
	</br>
		<div class="row">
			<div class="large-12 columns">
				{{ link_to('Item/'. $item->id, 'Return to ' . $item->name, $attributes = array('class' => 'button tiny radius', 'title' => 'Devices')) }}
			</div>
		</div>

			<table class="large-12 columns tableOne" id="tableTwo">
				<thead>
				   	<tr>
						<th>Actions Taken</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($devices as $location)
						@foreach ($location->locations as $device_location)
							<tr>
								<td width="200">{{ Form::label('deviceName', ' Device ' . $location->name . ' Was assigned to ' . $device_location->name . ' on '. $device_location->created_at , array('id' => 'Font', 'class' => 'large-12 columns')) }}</td>
							</tr>
						@endforeach
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection