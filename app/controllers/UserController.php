<?php

class UserController extends BaseController {


	public function showChangePass() {
		return View::make('changePassword');
	}

	public function changeUserPass() {
		$changepass = User::action_changePassword(Input::all());;
		return $changepass;
	}
}