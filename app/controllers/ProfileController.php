<?php

class ProfileController extends BaseController {


	public function showProfile() {
		$devices = Device::all();
	 	$items = Item::all();
			return View::make('profile')
		 		->with('items', $items)
		 		->with('devices', $devices);
	}

	public function showAll() {
		$retrieveAll = User::action_SearchAll(Input::all());
		return $retrieveAll;
	}
}