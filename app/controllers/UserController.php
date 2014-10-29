<?php

class UserController extends BaseController {


	public function showChangePass() {
		return View::make('changePassword');
	}

	public function changeUserPass() {
		$changepass = User::action_changePassword(Input::all());;
		return $changepass;
	}

	public function showSearchPage() {
		# code...
		$audit = Audit::all();
		$devices = Device::all();
		$items = Item::all();
		$locations = Location::all();
		return View::make('Search')->with('audit', $audit)
								->with('devices', $devices)
								->with('items', $items)
								->with('locations', $locations);
	}

	public function searchAll() {
		# code...
		$searchTb = Input::get('searchTb');
		$dateTb = Input::get('dateTb');
		$searchAll = User::action_SearchAll($searchTb, $dateTb);

		return $searchAll;
	}
}