@extends('Templates.mainPage')

<?php 

	//Declarations
	$ctr = 0;
	$ctr2 = 0;
?>

@section('header')
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
					<li class="active">{{ link_to('changePassword', 'Change Password') }}</a></li>
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

@section('bodySection')
<div class="large-11 columns large-centered">
	<h1>Inventory</h1>
</div>

<div class=" large-10 columns large-centered">
	<div class="row">
		<div class="large-9 columns">
			<div class="row">
				<div class="large-10 columns">
					{{ link_to('', ' Add Item', array('class' => 'button tiny radius', 'data-reveal-id' => 'myModal')) }}
					{{ link_to('/Location', 'Location', $attributes = array('class' => 'button tiny radius', 'title' => 'Add a Location for the Device')) }}
					{{ link_to('All/Track' , 'History', $attributes = array('class' => 'button tiny radius', 'title' => "Check all the actions taken on history.")) }}
					@if($errors->has()) 
						@foreach($errors->all() as $message)
							<span class="error">{{ $message }}</span>
						@endforeach
					@endif

					@if ($notification = Session::get('message'))
						<div data-alert class="alert-box success ">
							{{ $notification }}
							<a href="#" class="close">&times;</a>
						</div>
					@endif

					@if ($notification = Session::get('deleteMessage'))
						<div data-alert class="alert-box success ">
							{{ $notification }}
							<a href="#" class="close">&times;</a>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		{{ Form::open(array('url' => 'Item/{itmName}')) }}
		<div class="large-12 columns ">
			<table class="large-12 columns tableOne ">
	  			<thead>
	   				<tr>
      					<th class="font weight history-Header-bg">Item List</th>
      					<th class="font weight history-Header-bg">No. of Device in an Item</th>
      					<th class="font weight history-Header-bg">Actions</th>
					</tr>
				</thead>

				<tbody>
		  			@foreach ($items as $item)
		    			<tr>
							<td class="font weight">{{ link_to('Item/'. $item->id , $item->name, array('class' => 'tiny large-3 radius fontSize-Device', 'title' => "Go to Item's Profile", 'id' => $item->id)) }}</td>
							<td class="font weight">{{ count($item->device) }}</td>
							<td class="font weight">
								{{ link_to('Edit/'.$item->id, 'Edit', array( 'class' => 'button large-3 tiny radius', 'title' => 'Edit a Device')) }}
								{{ link_to('Item/delete/'.$item->id.csrf_token(), 'Delete', $attributes = array('class' => 'button large-3 tiny radius delete_user', 'title' => 'Delete selected Device', 'id' => $item->id .csrf_token() )) }}	
							</td>
		   				</tr>
		    		@endforeach
	  			</tbody>
			</table>
		</div>
		{{ Form::close() }}
	</div>
</div>
<!--ADD ITEM MODAL-->
<div id="myModal" class="reveal-modal small" data-reveal>
	{{ Form::open(array('url' => 'additem')) }}
	<div class="row">
		<div class="large-12 columns input_fields_wrap">
			<label id="modalLbl">Add Item</label>
			<div class="row">
				<div class="large-10 columns">
				  	<input type="text" placeholder="Enter the device name" id="textStyle" name="itemTb" class="radius">
				</div>
			</div>
			<div class="row">
				<div class="large-12 columns large-centered">
					<div class="row">
						<div class="large-10 columns">
							<label id="modalLbl">Item-Data</label>
								<input type="text" name="mytext[]" placeholder="Enter device data-field">
						</div>
					</div>
				</div>
			</div>
		</div>
		<a class="close-reveal-modal">&#215;</a>
		<div class="large-12 columns">
			<div class="row">
				<div class="large-12 columns">
					<input class="button tiny radius" type="submit" value="Add Item" name="submit">
					<Button class="button tiny radius add_field_button" id="Font"> Add Data-field</button>
				</div>
			</div>
		</div>
	</div>
	{{ Form::close() }}
</div>

<script>

	$(".delete_field").click(function(){
		if (!confirm("This Item and all its Devices will be permanently deleted and cannot be recovered. Are you sure?")) {
		return false;
		}
	});
</script>

@endsection