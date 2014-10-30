@extends('Templates.Report')

@section('reportHeader')
<nav class="top-bar small-12" data-topbar role="navigation">
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

@section('reportBody')
<div class="large-2 small-12 columns">
	<div class="sidebar">
		<ul class="side-nav">
			<li>{{ link_to('', 'Return to Main Page', array('class' => ' tiny radius', 'data-reveal-id' => 'myModal')) }}</li>
		</ul>
	</div>
</div>

<div class="large-10 small-12 columns">
	<div class="row">
		<div class="large-12 small-12 columns" >
		<h1>Live Report</h1>
			<table class="large-12 small-12 columns tableOne">
	  			<thead>
	   				<tr>
		      			<th class="font weight history-Header-bg table-item-align">Device Name</th>
						<th class="font weight history-Header-bg table-item-align">Assigned to</th>
						<th class="font weight history-Header-bg table-item-align">Date/Time Checked Out</th>
					</tr>
				</thead>

				<tbody>
				@foreach($device as $devices)
					<tr>
						<td class=" table-item-align"> {{ link_to('Device/Track/'.$devices->id , $devices->name, array( 'class'=>'fontSize-8', 'title' => "Go to ".$devices->name."'s profile.")) }} </td>
						<td class=" table-item-align"> {{ link_to('Location/Profile/'.$devices->location->id, $devices->location->name, array('class'=>'fontSize-8', 'title' => "Go to ".$devices->location->name."'s profile.")) }} </td>
						<td class=" table-item-align"> {{ date('F d, Y [ h:i A D ]', strtotime($devices->updated_at)) }} </td>
	   				</tr>
   				@endforeach
	  			</tbody>
			</table>
		</div>
	</div>
</div>
@endsection