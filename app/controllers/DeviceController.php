<?php

class DeviceController extends BaseController {

	public function updateDevInfo() {
		$update_device_information = Device::update_device_infos(Input::all());
		return $update_device_information;
	}

	public function addDevice() {
		$device = Device::registerDevice(Input::all());
		return $device;
	}

	public function assignDevice() {
		$dev_loc = DeviceLocation::action_Register_Device_Location(Input::all());
		return $dev_loc;
	}

	public function changeStatus() {
		$device_status = Device::changeStatus(Input::all());
		return $device_status;
	}

	public function showDevice($id) {
		$item = Item::find($id);
		$devices = Device::where('item_id', $id)->get();
		$location = Location::all();
		if($item == true) {
			return View::make('Device')
				->with('items', $item)
				->with('devices', $devices)
				->with('locations', $location);
		} else {
			return View::make('404');
		}
	}

	public function showTrack($id) {
		$retrieveTrack = Device::retrieveTrack($id);
		return $retrieveTrack;
	}

	public function showTracks($id) {
		//Get Device: ID, Name
		$getDevice = Device::where('item_id', $id)->get();
		//Get Item: Name
		$getItemName = Item::find($id);
		$item_name = $getItemName->name;

		$device_location = DeviceLocation::with('location.device')->where('item_id', $id)->get();

		if ($device_location == true) {
			return View::make('trackalldevice')
						->with('device_locations', $device_location)
						->with('getInfo', $getDevice)
						->with('itemName', $item_name);
		} else {
			return View::make('404');
		}
	}

	public function unassignDevice() {
		$device_location = DeviceLocation::unAssignDevice(Input::all());
		return $device_location;
	}
}