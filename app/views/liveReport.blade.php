@extends('Templates.Report')

<?php
	$ctr = 0;
	$initItem = array("");
	$initCount = array("");
?>

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
		<h1>Summary Report</h1>
			<table class="large-12 small-12 columns tableOne">
	  			<thead>
	   				<tr>
	   					<th class="font weight history-Header-bg table-item-align">#</th>
		      			<th class="font weight history-Header-bg table-item-align">Categories</th>
		      			<th class="font weight history-Header-bg table-item-align">Total Devices</th>
						<th class="font weight history-Header-bg table-item-align">Total assigned Devices</th>
						<th class="font weight history-Header-bg table-item-align">Total available Devices</th>
						<th class="font weight history-Header-bg table-item-align">Total disposed Devices</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($item as $items)
							<tr>
								<td class="table-item-align">{{ ++$ctr }}</td>
								<td class="table-item-align">{{ $items->name }}</td>
								<td class="table-item-align">{{ count($items->device) }}</td>
								@foreach ($a_device as $a_id)
									@if ($a_id->item_id == $items->id)
										@if ($initItem == '' or $initItem != count($a_id->item_id))
										
										<td class="table-item-align">{{ $initItem = count($a_id->item_id) }}</td>
										{{ $initItem = $a_id->item_id }}
										@endif
									@endif
								@endforeach
								<td class="table-item-align"></td>
								<td class="table-item-align"></td>
							</tr>
					@endforeach
	  			</tbody>
			</table>
		</div>
	</div>
</div>
@endsection