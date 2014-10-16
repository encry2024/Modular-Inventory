<?php

class LoginController extends BaseController {
	/**
	*	Show login page
	**/
	public function showLogin() {
		$chkUser = User::all();

		if (count($chkUser) == 0) {
			return View::make('register');
		}

		return View::make('login');
	}

	/**
	*	Try to authenticate user
	**/
	public function authenticate() {

		$login = User::tryAuthenticate(Input::all());

		return $login;
	}
}
