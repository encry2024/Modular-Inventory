@extends('Templates.login')


@section('bodyLogin')

<div class="row" id="login">
	<div class="large-5 small-8 small-centered columns">
		<!-- LOGO -->
		<div class="row">
			<div class="large-12 small-12 columns">
			</br>
				{{HTML::image('img/portal-logo.png')}}
			</div>
		</div>
		<br>
		<br>
		<div class="row">
			<div class="large-12 columns">
				{{ Form::open(array('url' => 'authenticate')) }}
					<div class="row">
						<div class="large-12 columns">
							<input type="text" class="radius textAlign" placeholder="Enter your username" name="username">
						</div>
					</div>

					<div class="row">
						<div class="large-12 columns">
							<input type="password" class="radius textAlign" placeholder="Enter your password" name="password">
						</div>
					</div>

					<div class="row">
						<div class="large-12 columns">
							 <input type="submit" value="Login" class="button large alert expand login-button" name="Login" />
						</div>
					</div>
			    	{{ Form::close() }}
			    	{{ link_to('register', 'Register User', array('class'=>'button small right')) }}

					@if($errors->has()) 
						@foreach($errors->all() as $message)
							<span class="error">{{ $message }}</span>
						@endforeach
					@endif

					@if ($alert = Session::get('message'))
			    			<div data-alert class="alert-box alert round">
			        			{{ $alert }}
			        			<a href="#" class="close">&times;</a>
			    			</div>
					@endif
			</div>
		</div>
	</div>
</div>
@endsection