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
				<h1>Search {{ $item_name }} Items </h1>
			</div>
		</div>
	</div>
</div>

<div class=" large-10 columns large-centered">
	<div class="row">
		<div class="large-4 columns">
			<div class="row">
				<div class="large-12 columns">
					{{ Form::label('', 'Search Device: ') }}
				</div>
			</div>
			<input id="mysearch2" type="Search" placeholder="search">
		</div>
	</div>
</div>

<div>
	<div>
		
	</div>
</div>
@endsection