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
<div class="row">
	<div class="large-11 columns large-Centered">
		<div class="row">
			<div class="large-12 columns">
<<<<<<< HEAD
				<h1 class="font">History</h1>
=======
				<h1>History</h1>
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
			</div>
		</div>
	</div>
</div>
<div class=" large-10 columns large-centered">
	<div class="row">
		<div class="large-12 columns">
			<div class="row">
				<div class="large-12 columns">
					<div class="row">
						<div class="large-12 columns">
							{{ link_to('/', 'Home', $attributes = array('class' => 'button tiny large-2', 'title' => 'Return Home')) }}
						</div>
					</div>
				</div>
			</div>
<<<<<<< HEAD
</br>
=======
			</br>
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
			@foreach ($audits as $audit)
			<div class="row">
				<div class="large-12 columns">
					<?php
						if($initDate == '' OR $initDate != date('F d, Y', strtotime($audit->created_at))) {
							$initDate = date('F d, Y', strtotime($audit->created_at));
							echo "<div class='panel font textAlign history-Header-bg' id='trackAll-Style-panel-header'><b>".$initDate."</b></div>";
						}
						$audit_time = date('h:i A', strtotime($audit->created_at));
					?>
<<<<<<< HEAD
						<label class='font'><b>{{ $audit_time }}</b> - {{ $audit->history }} </label>
=======
					<label class='font'><b>{{ $audit_time }}</b> - {{ $audit->history }} </label>
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection