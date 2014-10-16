<?php

class LocationController extends BaseController {

	public function viewLocation() {
		$locations = Location::all();
		$devices = Device::all();
		return View::make('location')
					->with('devices', $devices)
					->with('location', $locations);
	}

	public function addLocation() {
		$createLocation = Location::create_Location(Input::all());
		return $createLocation;
	}

}