<?php

class ProfileController extends BaseController {


	public function showProfile() {
		$devices = Device::all();
	 	$items = Item::all();
			return View::make('profile')
		 		->with('items', $items)
		 		->with('devices', $devices);
	}
}