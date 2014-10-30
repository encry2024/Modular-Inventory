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

	public function viewProfile($id) {
		$location = Location::find($id);
		$locationLog = DeviceLog::where('location_id', $id)->orderBy('created_at','desc')->get();
		$devices = Device::where('location_id', $id)->get();
		
		return View::make('locationProfile')->with('locationLog', $locationLog)
											->with('locationName', $location->name)
											->with('locationId', $location->id)
											->with('devices', $devices);
	}

	public function editLocationName() {
		# code...
		$editLocation = Location::action_LocationName(Input::all());
		return $editLocation;
	}
}