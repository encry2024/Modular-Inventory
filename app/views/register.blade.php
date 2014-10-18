<<<<<<< HEAD
@extends('Templates.User')

=======
@extends('Templates.register')

@section('registerBody')
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
<div class="row" id="login">
	<div class="large-5 small-8 small-centered columns">
		<!-- LOGO -->
		<div class="row">
			<div class="large-12 small-12 columns">
<<<<<<< HEAD
				{{HTML::image('img/portal-logo2.jpg')}}
=======
				<h1 class="fontAlign">USER REGISTRATION</h1>
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
			</div>
		</div>
		<br>
		<br>
<<<<<<< HEAD
=======
		<br>
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
		<div class="row">
			<div class="large-12 small-12 columns">
				{{ Form::open(array('url' => 'registeruser')) }}
					<div class="row">
						<div class="large-12 columns">
<<<<<<< HEAD
							<input type="text" class="radius" placeholder="Enter your username" name="username">
=======
							<input type="text" class="radius fontAlign font fontSize-3 fontWeight" placeholder="Enter your username" name="username">
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
<<<<<<< HEAD
							<input type="password" class="radius" placeholder="Enter your password" name="password">
=======
							<input type="password" class="radius fontAlign font fontSize-3 fontWeight" placeholder="Enter your password" name="password">
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
<<<<<<< HEAD
							<input type="password" class="radius" placeholder="Confirm your password" name="confirmPassword">
=======
							<input type="password" class="radius fontAlign font fontSize-3 fontWeight" placeholder="Confirm your password" name="confirmPassword">
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
<<<<<<< HEAD
							<input type="text" class="radius" placeholder="Enter your Firstname" name="firstName">
=======
							<input type="text" class="radius fontAlign font fontSize-3 fontWeight" placeholder="Enter your Firstname" name="firstName">
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
<<<<<<< HEAD
							<input type="text" class="radius" placeholder="Enter your Lastname" name="lastName">
=======
							<input type="text" class="radius fontAlign font fontSize-3 fontWeight" placeholder="Enter your Lastname" name="lastName">
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
<<<<<<< HEAD
							<input type="submit" class="radius" class="button large alert expand" />
=======
							<input type="submit" class="button large alert expand login-button radius" />
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
						</div>
					</div>
			    	{{ Form::close() }}
			    	<br>
			    	
				@if ($alert = Session::get('message'))
		    			<div class="alert-box alert">
		        			{{ $alert }}
		    			</div>
				@endif

				@if($errors->has()) 
					@foreach($errors->all() as $message)
						<span class="error">{{ $message }}</span>
					@endforeach
				@endif
			</div>
		</div>
	</div>
</div>
<<<<<<< HEAD
=======
@endsection
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
