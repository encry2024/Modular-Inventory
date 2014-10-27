@extends('Templates.Edit')

@section('headSection')
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

@section('itemBody')
</br>
<div class="large-11 columns large-centered container">
	<h1>Edit {{ $item->name }} Field </h1>
</div>
<div class="large-9 columns large-centered">
	<div class="row">
		<div class="large-12 columns">
			<div class="row">
					
			</div>
			<div class="row">
				<div class="large-6 columns">
					{{ link_to('Item/'.$item->id, 'Home', $attributes = array('class' => 'button tiny large-3 radius', 'title' => 'Return Home')) }}
				</div>
			</div>
		</div>
	</div>
</br>
<div class="large-12 columns large-centered">
{{ Form::open(array('url'=>'updateitem')) }}
	<div class="row">
		<div class="large-9 columns large-centered input_fields_wrap">
			<div class="row">
				<div class="large-12 columns">
					@foreach ($fields as $itemField)
						<div class="row">
							<div class="large-12 columns large-centered">
								<div class="row">
									<div class="large-10 columns">
										{{ Form::text('',$itemField->item_label, array('name' => 'field-'.$itemField->id, 'class'=>'inputField radius')) }}
									</div>
										{{ link_to('Field/delete/'.$itemField->id, 'Delete', $attributes = array('class' => 'button tiny radius delete_field', 'title' => 'Delete selected Device', 'id' => $item->id .csrf_token() )) }}	
									</a>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	{{ Form::hidden('iId', $item->id) }}
	{{ Form::hidden('iName', $item->name) }}

	<div class="row">
		<div class="large-9 columns large-centered">
			<div class="row">
				<div class="large-10 columns">
					{{ Form::submit('Update', $attributes = array('class' => 'button tiny small-2 radius', 'title' => "Click update to change the Item's Information")) }}
					{{ link_to('/', 'Add Field', $attributes = array('class' => 'button tiny small-2 radius add_field_button', 'title' => 'Return Home')) }}
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
{{ Form::close() }}
</div>
<script>
	$(".delete_field").click(function(){
		if (!confirm("This Field will be permanently deleted and cannot be recovered. Are you sure?")) {
		return false;
		}
	});
</script>
@endsection