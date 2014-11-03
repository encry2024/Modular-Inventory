@extends('Templates.login')

@section('bodyLogin')
<br>
<div class="large-6 small-12 columns large-centered">
	<div class="row">
		
			<h1 class="text-size-20 label-weight-bold large-12 fi-torso size-18 label-black"> User Login</h1>
		<br>
		{{ Form::open(array('url'=>'authenticate')) }}
			<div class="row">
				<div class="large-10 columns large-centered">
					<div class="large-3 columns">
						{{ Form::label('', 'Username', array('class'=>'text-lineHeight label-weight-bold font-size-12')) }}
					</div>
					<div class="large-9 columns">
						{{ Form::text('username', Input::old('username') , array('class'=>'radius error text-center', 'placeholder'=>'Enter your Username')) }}
						@if ($errors->has('username')) <small class="error">{{ $errors->first('username') }}</small> @endif
					</div>
				</div>
			</div>

			<br>

			<div class="row">
				<div class="large-10 columns large-centered">
					<div class="large-3 columns">
						{{ Form::label('', 'Password', array('class'=>'text-lineHeight label-weight-bold font-size-12')) }}
					</div>
					<div class="large-9 columns">
						{{ Form::password('password', array('class'=>'radius error text-center', 'placeholder'=>'Enter your Password')) }}
						@if ($errors->has('password')) <small class="error">{{ $errors->first('password') }}</small> @endif
					</div>
				</div>
			</div>

			<br>

			<div class="row">
				<div class="large-10 small-12 columns large-centered">
					<div class="large-12 columns">
						{{ Form::submit('Login', array('class'=>'large-3 small-12 button right tiny radius text-size-12')) }}
					</div>
				</div>
			</div>

			{{ Form::close() }}

			<br>

			<div class="row">
				<div class="large-10 small-12 columns large-centered small-centered">
					<div class="large-12 columns">
						{{ link_to('', 'Forgot password?', array('class'=>'label-weight-bold right text-size-12 link-lineHeight')) }}
					</div>
					<div class="large-12 columns">
						{{ link_to('/register', "Register Account", array('class'=>'label-weight-bold right text-size-12 link-lineHeight ')) }}
					</div>
				</div>
			</div>

			<br>

			@if ($alert = Session::get('flash_error'))
				<div data-alert class="error radius">
					{{ $alert }}
				</div>
			@endif

		
	</div>
</div>

@endsection