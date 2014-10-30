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
					<li class="divider"></li>
					<li>{{ link_to('logout','Logout') }} </li>
					<li>{{ link_to('changePassword', 'Change Password') }}</a></li>
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

@section('bodySection')
<div class="large-2 small-12 columns">
	<div class="sidebar">
		<ul class="side-nav">
			<li>{{ link_to('', ' Add Item', array('class' => ' tiny radius', 'data-reveal-id' => 'myModal')) }}</li>
			<li>{{ link_to('/Location', 'Location', $attributes = array('class' => ' tiny radius', 'title' => 'Add a Location for the Device')) }}</li>
			<li>{{ link_to('/Search', 'Search', array("class"=>"tiny large-12 radius"))}}</li>
			<li>{{ link_to('All/Track' , 'History', $attributes = array('class' => ' tiny radius', 'title' => "Check all the actions taken on history.")) }}</li>
			<li>{{ link_to('/LiveReport', 'Live Report', array("class"=>"tiny large-12 radius", "title"=>"Check all the Device that is being used.")) }}</li>
		</ul>
	</div>
</div>

<div class=" large-10 small-12 columns">
	<div class="row">
		<div class="large-11 small-12 columns">
			<h1>Inventory</h1>
				<div class="row">
					<div class="large-10 small-12 columns">
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
			{{ Form::open(array('url' => 'Item/{itmName}')) }}
				<table class="large-12 small-12 columns tableOne">
		  			<thead>
		   				<tr>
	      					<th class="font weight history-Header-bg table-item-align">Item List</th>
	      					<th class="font weight history-Header-bg table-item-align">No. of Device in an Item</th>
	      					<th class="font weight history-Header-bg table-item-align">Date/Time Added</th>
						</tr>
					</thead>

					<tbody>
			  			@foreach ($items as $item)
			    			<tr>
								<td class=" table-item-align">{{ link_to('Item/'. $item->id , $item->name, array('class'=>'font-1 fontSize-8 fontWeight', 'title' => "Go to Item's Profile", 'name' => 'item-' . $item->id)) }}</td>
								<td class=" table-item-align">{{ count($item->device) }}</td>
								<td class=" table-item-align">
									{{ Form::label('', date('F d, Y / h:i A D', strtotime($item->created_at)), array('class'=>'font-1 fontSize-8 fontWeight')) }}	
								</td>
			   				</tr>
			    		@endforeach
		  			</tbody>
				</table>
			</div>
			{{ Form::close() }}
		</div>
	</div>
</div>

<!--ADD ITEM MODAL-->
<div id="myModal" class="reveal-modal small" data-reveal>
	{{ Form::open(array('url' => 'additem')) }}
	<div class="row">
		<div class="large-12 small-12 columns input_fields_wrap">
			<label id="modalLbl">Add Item</label>
			<div class="row">
				<div class="large-10 small-12 columns">
				  	<input type="text" placeholder="Enter the device name" id="textStyle" name="itemTb" class="radius">
				</div>
			</div>
			</br></br>
			<div class="row">
				<div class="large-12 small-12 columns large-centered">
					<div class="row">
						<div class="large-10 small-12 columns">
							<label id="modalLbl">Item-Data</label>
							<input type="text" value="Manufacturer" name="mytext[]" placeholder="Enter device data-field">
							<input type="text" value="Department" name="mytext[]" placeholder="Enter device data-field">
							<input type="text" value="Purchased Date" name="mytext[]" placeholder="Enter device data-field">
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