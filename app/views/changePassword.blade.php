@extends('Templates.register')

@section('registerBody')
<div class="row" id="login">
	<div class="large-5 small-8 small-centered columns">
		<!-- LOGO -->
		<div class="row">
			<div class="large-12 small-12 columns">
				<h1 class="fontAlign">Change Password</h1>
			</div>
		</div>
		<br>
		<br>
		<br>
		<div class="row">
			<div class="large-12 small-12 columns">
				{{ Form::open(array('url' => 'changepass')) }}
					<div class="row">
						<div class="large-12 columns">
							<input type="password" class="radius fontAlign font fontSize-3 fontWeight" placeholder="Enter your old password" name="oldPass">
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<input type="password" class="radius fontAlign font fontSize-3 fontWeight" placeholder="Enter your new password" name="newPass">
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<input type="password" class="radius fontAlign font fontSize-3 fontWeight" placeholder="Confirm your new password" name="confirmPassword">
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<input type="submit" value="Change Password" class="button large alert expand login-button radius" />
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
@endsection