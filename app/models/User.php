<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	//protected $primaryKey = 'admin_id';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	public function audit() {
		return $this->hasMany('Audit');
	}

	protected $hidden = array('password', 'remember_token');


	public static function tryRegister($data) {
		//get all data
		//data to validate
		$values = array(
			'username' => $data['username'],
			'password' => $data['password'],
			'firstname' => $data['firstName'],
			'lastname' => $data['lastName']
		);

		//rules
		$rules =array(
			'username' => 'required|unique:users,username|alpha_num',
			'password' => 'required',
			'firstname' => 'required',
			'lastname' => 'required'
		);

		//create validation instance
		$validation = Validator::make($values, $rules);

		//check if validation successful
		if($validation->fails()) {
			return Redirect::back()
				->withErrors($validation);
			//return var_dump($validation->messages());
		} else {
			
			$user = new User;
			$user->username = $data['username'];
			$user->password = Hash::make($data['password']);
			$user->firstname = $data['firstName'];
			$user->lastname = $data['lastName'];

			$user->save();

			$users_username = $user->username;
			$user_name = $user->firstname ." ". $user->lastname;
			//if (Auditdate::select('date_created')->whereNull('date_created')->get()) {
			
			$audits = new Audit;
			$audits->history = $user_name . " created an account named " . $users_username .".";
			$audits->save();

			return Redirect::to('login');
		}
	}

	public static function tryAuthenticate($data) {
		$values = array(
			'username' => $data['username'],
			'password' => $data['password']
		);
	
		$rules =array(
			'username' => 'required',
			'password' => 'required'
		);
	
		$validation = Validator::make($values, $rules);

		if($validation->fails()) {
			return Redirect::back()
				->withErrors($validation);
		}


		if (Auth::attempt(array('username' => $data['username'], 'password' => $data['password'])))
<<<<<<< HEAD
		{	

			return Redirect::to('/');

			
=======
		{
			return Redirect::to('/');
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
		} else {
			return Redirect::back()
				->with('message', 'Invalid username/password');
		}
	}
<<<<<<< HEAD
=======

	public static function action_changePassword($data) {
		$user = User::find(Auth::user()->id);

		if(Hash::check($data["oldPass"], Auth::user()->password)) {
			if ($data["newPass"] == $data["confirmPassword"]) {
				$user->password = Hash::make($data["newPass"]);
				$user->save();

				$audits = new Audit;
				$audits->history = Auth::user()->firstname . " " . Auth::user()->lastname . " has changed his/her password.";
				$audits->save();

				Auth::logout();

				return Redirect::to('login');
			} else {
				return Redirect::to('changePassword')
								 ->with('message', 'Password do not match.');
			}
		} else {
			return Redirect::to('changePassword')
							 ->with('message', 'Your old password is incorrect.');
		}
	}
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
}
