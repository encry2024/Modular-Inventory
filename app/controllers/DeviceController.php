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

<<<<<<< HEAD
=======
	public function changeStatus() {
		$device_status = Device::changeStatus(Input::all());
		return $device_status;
	}

>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
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
<<<<<<< HEAD

		//Get item_id on Device
		$device_item_id = $device->item_id;
		
		//Get all the Location of a specific Device
		$device_location = DeviceLocation::where('device_id', $id)->get();
=======
		//Get item_id on Device
		$device_item_id = $device->item_id;
		//Get Item by the Device's item_id
		$item = Item::find($device_item_id);
		//Get all the Location of a specific Device
		$device_location = DeviceLocation::where('device_id', $id)->get();
		//Get Devices with Location
		$devices = Device::with('location')->where('id', $id)->get();
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184

		if($device == true) {
				return View::make('trackdevice')
					->with('devices', $device_item_id)
<<<<<<< HEAD
					->with('device_location', $device_location);
=======
					->with('device_location', $device_location)
					->with('device', $device)
					->with('dvc', $devices)
					->with('item', $item);
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
			} else {
				return View::make('404');
		}
	}

	public function showTracks($id) {
<<<<<<< HEAD
		$getDevice = Device::find($id);
		$getDeviceItemId = $getDevice->item_id;
		$getDeviceName = $getDevice->name;
=======
		//Get Device: ID, Name
		$getDevice = Device::find($id);

		//Get Item: Name
		$getItemName = Item::find($getDevice->item_id);
		$item_name = $getItemName->name;
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184

		$device_location = DeviceLocation::with('location.device')->get();

		if ($device_location == true) {
			return View::make('trackalldevice')
<<<<<<< HEAD
							->with('device_locations', $device_location)
							->with('item_id', $getDeviceItemId)
							->with('device_name', $getDeviceName);
=======
						->with('device_locations', $device_location)
						->with('getInfo', $getDevice)
						->with('itemName', $item_name);
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
		}
	}

	public function unassignDevice() {
		$device_location = DeviceLocation::unAssignDevice(Input::all());
		return $device_location;
	}
}