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
<div class="large-11 columns large-centered">
	<h1 class="font">Locations</h1>
</div>

<div class=" large-10 columns large-centered">
	<div class="row">
			<div class="large-9 columns">
				<div class="row">
					<div class="large-10 columns">
						{{ link_to('', 'Add Location', array('class' => 'button tiny radius', 'data-reveal-id' => 'assignModal')) }}
						{{ link_to('/' , 'Home', array('class' => 'button tiny radius', 'title' => "Go back to Main Page.")) }}
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="large-12 columns ">
			<table class="large-12 columns tableOne ">
	  			<thead>
	   				<tr>
      					<th class="font weight history-Header-bg">Locations</th>
      					<th class="font weight history-Header-bg">Devices</th>
      					<th class="font weight history-Header-bg">Date Created</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($location as $locations)
			    			<tr>
								<td class="font weight">{{ Form::label('', $locations->name) }}</td>
								<td class="font weight">{{ Form::label('', '', '') }}</td>
								<td class="font weight">{{ Form::label('', $locations->created_at, '') }}</td>
			   				</tr>
			   			@endforeach
	  			</tbody>
			</table>
		</div>
	</div>
</div>

<div id="assignModal" class="reveal-modal small" data-reveal>
	{{ Form::open(array('url' => 'addlocation')) }}
	<div class="large-12 columns">
		<h1 class="font">Add Location</h1>
	</div>
	<div class="row">
		<div class="large-8 columns">
			<div class="large-12 columns">
				
				{{ Form::hidden('idTb', '', array('name' => 'idTb', 'id'=>'id_textbox' )) }}
			</br>
			</div>

			<div class="large-12 columns">
				{{ Form::label('', "Location's name", array('class'=>'size-24', 'id'=>'Font')) }}
				{{ Form::text('locationTb', '' , array('class' => 'radius', 'placeholder' => 'Enter Locations name')) }}
			</div>

			</div>

			<div class="large-12 columns">
				<div class="large-2 columns">
					{{ Form::submit('Add Location' , $attributes = array('class' => 'button tiny radius', 'name' => 'submit')) }}
				</div>
			</div>
		</div>
		<a class="close-reveal-modal">&#215;</a>
	</div>
	{{ Form::close() }}
</div>
@endsection

