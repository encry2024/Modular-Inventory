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
		$assign_device = Device::action_AssignDevice(Input::all());
		return $assign_device;
	}

	public function unassignDevice() {
		$device_location = Device::unAssignDevice(Input::all());
		return $device_location;
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
		$getItem = Item::find($id);
		$item_name = $getItem->name;
		$item_id = $getItem->id;

		//Get Device Name
		$device = Device::where('item_id', $item_id);

		//Get Device and Location based on device id.
		$device_location = Item::with('devicelog')->where('id', $item_id)->orderBy('created_at', 'asc')->get();
		if ($device_location == true) {

			return View::make('trackalldevice')
			->with('device_locations', $device_location)			
			->with('getInfo', $getDevice)
			->with('itemName', $item_name)
			->with('itemId', $item_id);

		} else {
			return View::make('404');
		}
	}

}