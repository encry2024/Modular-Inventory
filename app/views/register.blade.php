
@extends('Templates.login')

@section('bodyLogin')

<div class="large-8 columns">
	<ul class="breadcrumbs">
		<li>{{ link_to('/login', 'Login') }}</li>
		<li class="unavailable"><a href="#">Registration Page</a></li>
	</ul>
</div>
<br><br>

<div class="large-6 columns large-centered">
	<div class="row">
		<h1 class="large-12 label-black">User Registration<div class=" foundicon-people size-24 push-6"></div></h1>
		<br>
		{{ Form::open(array('url' => 'registeruser')) }}
			<div class="row">
				<div class="large-10 columns large-centered">
					<div class="large-3 columns">
						{{ Form::label('', 'Username', array('class'=>'text-lineHeight label-weight-bold font-size-14')) }}
					</div>
					<div class="large-8 columns">
						{{ Form::text('username', Input::old('username'), array('class'=>'error text-center ', 'placeholder'=>'Enter your Username')) }}
						@if ($errors->has('username')) <small class="error">{{ $errors->first('username') }}</small> @endif
					</div>
				</div>
			</div>

			<br>

			<div class="row">
				<div class="large-10 columns large-centered">
					<div class="large-3 columns">
						{{ Form::label('', 'Password', array('class'=>'text-lineHeight label-weight-bold font-size-14')) }}
					</div>
					<div class="large-8 columns">
						{{ Form::password('password', array('class'=>'error text-center ', 'placeholder'=>'Enter your Password')) }}
						@if ($errors->has('password')) <small class="error">{{ $errors->first('password') }}</small> @endif
					</div>
				</div>
			</div>

			<br>

			<div class="row">
				<div class="large-10 columns large-centered">
					<div class="large-4 columns">
						{{ Form::label('', 'Confirm Password', array('class'=>'text-lineHeight label-weight-bold font-size-14')) }}
					</div>
					<div class="large-8 columns">
						{{ Form::password('password_confirmation', array('class'=>'error  text-center', 'placeholder'=>'Confirm your Password')) }}
						@if ($errors->has('password_confirmation')) <small class="error">{{ $errors->first('password_confirmation') }}</small> @endif
					</div>
				</div>
			</div>

			<br>

			<div class="row">
				<div class="large-10 columns large-centered">
					<div class="large-3 columns">
						{{ Form::label('', 'Firstname', array('class'=>'text-lineHeight label-weight-bold font-size-14')) }}
					</div>
					<div class="large-8 columns">
						{{ Form::text('firstname', Input::old('firstname'), array('class'=>' error  text-center', 'placeholder'=>'Enter your Firstname')) }}
						@if ($errors->has('firstname')) <small class="error">{{ $errors->first('firstname') }}</small> @endif
					</div>
				</div>
			</div>

			<br>

			<div class="row">
				<div class="large-10 columns large-centered">
					<div class="large-3 columns">
						{{ Form::label('', 'Lastname', array('class'=>'text-lineHeight label-weight-bold font-size-14')) }}
					</div>
					<div class="large-8 columns">
						{{ Form::text('lastname', Input::old('lastname'), array('class'=>'error  text-center', 'placeholder'=>'Enter your Lastname')) }}
						@if ($errors->has('lastname')) <small class="error">{{ $errors->first('lastname') }}</small> @endif
					</div>
				</div>
			</div>

			<br>

			<div class="row">
				<div class="large-10 columns large-centered">
					<div class="large-12 columns">
						{{ Form::submit('Register', array('class'=>'right large-3 button tiny radius text-size-14')) }}
					</div>
				</div>
			</div>

		{{ Form::close() }}
		
	</div>
</div>
@endsection
