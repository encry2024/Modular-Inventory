<?php

class RegisterController extends BaseController {


	public function showRegister() {
		return View::make('register');
	}
	public function registerUser() {
		$register = User::tryRegister(Input::all());

		return $register;
	}
}