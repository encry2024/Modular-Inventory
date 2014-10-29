@extends('Templates.device')

@section('deviceHeader')
<?php 
	$initDate = array("");
	$audit_history = "";

?>
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
<div class="row">
	<div class="large-12 columns large-Centered">
		<div class="row">
			<div class="large-12 columns">
				<h1>Search All</h1>
			</div>
		</div>
	</div>
</div>

<div class=" large-10 columns large-centered">
	<div class="row">
		<div class="large-4 columns">
			<div class="row">
				<div class="large-12 columns">
					{{ Form::label('', 'Search All: ') }}
				</div>
			</div>
			{{ Form::text('searchTb', '', array('name'=>'searchTb', 'placeholder'=>'Enter your Keyword', 'class'=>'radius')) }}
			{{ link_to('' , 'Find it', array('class'=>' button tiny radius success font-1 fontSize-6 fontWeight' ,'title' => "Click to check this device's tracks.")) }}
		</div>
	</div>
</div>

<div class="large-12 small-12 columns large-centered">
	<div class="row">
		<div class="large-12 small-12 columns" >
			<table class="display" id="tableSearch" cellspacing="0" width="100%">
	  			<thead>
	   				<tr>
		      			<th class="hAlign">RECORDS</th>
					</tr>
				</thead>

				<tbody>
				@foreach ($audit as $audits)
					<tr>
						<td>
							{{ $audits->history }}
						</td>
					</tr>
				@endforeach
	  			</tbody>
			</table>

			<table class="display" id="tableSearch" cellspacing="0" width="100%">
	  			<thead>
	   				<tr>
		      			<th class="hAlign">DEVICES</th>
					</tr>
				</thead>

				<tbody>
				@foreach ($devices as $device)
					<tr>
						<td>
							{{ $device->name }}
						</td>
					</tr>
				@endforeach
	  			</tbody>
			</table>

			<table class="display" id="tableSearch" cellspacing="0" width="100%">
	  			<thead>
	   				<tr>
		      			<th class="hAlign">FIELDS</th>
					</tr>
				</thead>

				<tbody>
				@foreach ($fields as $field)
					<tr>
						<td>
							{{ $field->item_label }}
						</td>
					</tr>
				@endforeach
	  			</tbody>
			</table>

			<table class="display" id="tableSearch" cellspacing="0" width="100%">
	  			<thead>
	   				<tr>
		      			<th class="hAlign">INFORMATIONS</th>
					</tr>
				</thead>

				<tbody>
				@foreach ($informations as $info)
					<tr>
						<td>
							{{ $info->value }}
						</td>
					</tr>
				@endforeach
	  			</tbody>
			</table>

			<table class="display" id="tableSearch" cellspacing="0" width="100%">
	  			<thead>
	   				<tr>
		      			<th class="hAlign">ITEMS</th>
					</tr>
				</thead>

				<tbody>
				@foreach ($items as $item)
					<tr>
						<td>
							{{ $item->name }}
						</td>
					</tr>
				@endforeach
	  			</tbody>
			</table>
		</div>
	</div>
</div>
@endsection