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
<div class=" large-10 columns large-centered">
	<div class="row">
		<div class="large-12 columns">
			<h3>-Track {{ $items->name }} Device Added Dates-</h3>
		</div>
	</div>
	</br>
	<div class="row">
		<div class="large-5 columns">
			{{ link_to('Item/'. $items->id, 'Return to ' . $items->name, $attributes = array('class' => 'button tiny radius', 'title' => 'Return to device page')) }}
		</div>
	</div>
	<div class="row">
		<div class="large-12 columns">
			<table class="large-12 columns tableOne" id="tableTwo">
				<thead>
				   	<tr>
						<th>Track Device added to the database</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($devices as $device)
						<tr>
							<td>
								{{ Form::label('deviceName', ' Device ' . $device->name . ' was added to the database on ' . $device->created_at , array('id' => 'Font', 'class' => 'large-12 columns')) }}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
<!--MODALS-->
<div id="editName" class="reveal-modal small" data-reveal>

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
@endsection