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

			'firstname' => $data['firstname'],
			'lastname' => $data['lastname']
		);

		//rules
		$rules = array(
			'username' => 'required|unique:users,username|alpha_num',
			'password' => 'required|confirmed',
			'password_confirmation' => 'required',
			'firstname' => 'required',
			'lastname' => 'required'
		);
		
		//create validation instance
		$validation = Validator::make(Input::all(), $rules);

		//check if validation successful
		if($validation->fails()) {
			return Redirect::back()
				->withErrors($validation)->withInput();
			//return var_dump($validation->messages());
		} else {
			$user = new User;
			$user->username = $data['username'];
			$user->password = Hash::make($data['password']);
			$user->firstname = $data['firstname'];
			$user->lastname = $data['lastname'];

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
	
		$rules = array(
			'username' => 'required',
			'password' => 'required'
		);
	
		$validation = Validator::make($values, $rules);

		if($validation->fails()) {
			return Redirect::back()
				->withErrors($validation)->withInput();
		}


		if (Auth::attempt(array('username' => $data['username'], 'password' => $data['password'])))

		{
			return Redirect::to('/');
		} else {
			return Redirect::back()
				->with('message', 'Invalid username/password')->withInput();
		}
	}


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

	public static function action_SearchAll($searchTb, $dateTb) {
		# code...
		// Audit::where('history' , 'LIKE', '%'.$searchTb.'%')
		// 				->where("DATE_FORMAT(created_at, '%m/%d/%Y')", 'LIKE', '%'.$dateTb.'%')->get()
		$audit = DB::select("SELECT * FROM inv_audits WHERE DATE_FORMAT(created_at, '%m/%d/%Y') LIKE '%".$dateTb."%' AND history LIKE '%".$searchTb."%'");
		$devices = DB::select("SELECT * FROM inv_devices WHERE DATE_FORMAT(created_at, '%m/%d/%Y') LIKE '%".$dateTb."%' AND name LIKE '%".$searchTb."%' OR deleted_at = ''");
		$items = DB::select("SELECT * FROM inv_items WHERE DATE_FORMAT(created_at, '%m/%d/%Y') LIKE '%".$dateTb."%' AND name LIKE '%".$searchTb."%' OR deleted_at = ''");
		$locations = DB::select("SELECT * FROM inv_locations WHERE DATE_FORMAT(created_at, '%m/%d/%Y') LIKE '%".$dateTb."%' AND name LIKE '%".$searchTb."%' OR deleted_at = ''");

		return View::make('Search')->with('audit', $audit)
								->with('devices', $devices)
								->with('items', $items)
								->with('locations', $locations);
	}
}
