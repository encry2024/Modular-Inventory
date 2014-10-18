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
		//Search device id
		$device = Device::find($id);

		//Get item_id on Device
		$device_item_id = $device->item_id;
		
		//Get all the Location of a specific Device
		$device_location = DeviceLocation::where('device_id', $id)->get();

		if($device == true) {
				return View::make('trackdevice')
					->with('devices', $device_item_id)
					->with('device_location', $device_location);
			} else {
				return View::make('404');
		}
	}

	public function showTracks($id) {
		$getDevice = Device::find($id);
		$getDeviceItemId = $getDevice->item_id;
		$getDeviceName = $getDevice->name;

		$device_location = DeviceLocation::with('location.device')->get();

		if ($device_location == true) {
			return View::make('trackalldevice')
							->with('device_locations', $device_location)
							->with('item_id', $getDeviceItemId)
							->with('device_name', $getDeviceName);
		}
	}

	public function unassignDevice() {
		$device_location = DeviceLocation::unAssignDevice(Input::all());
		return $device_location;
	}
}