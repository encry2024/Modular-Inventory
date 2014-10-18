<?php

class ItemsController extends BaseController {

	public function addItem() {
		$item = Item::registerItem(Input::all());
		return $item;
	}

	public function showItem($id) {
		$item = Item::find($id);
		$devices = Device::where('item_id', $id)->orderBy('created_at', 'desc')->get();
		$locations = Location::lists('name','id');

		$device_location = Device::with('location')->get();

		if($item == true) {
			return View::make('Item')
				->with('item', $item)
				->with('devices', $devices)
				->with('locations', $locations)
				->with('device_location', $device_location);
		} else {
			return View::make('404');
		}
	}

	public function showTracks($id) {
		$item = Item::find($id);
		$devices = Device::where('item_id', $id)->get();
		$locs = Location::all();

		if($item == true) {
			return View::make('Trackassign')
				->with('item', $item)
				->with('devices', $devices)
				->with('locs', $locs);
		} else {
			return View::make('404');
		}
	}
	
	public function editItem($id) {
		$item = Item::find($id);
		$fields = Field::where('item_id', $id)->get();
		//$infos = Info::where('field_id', $fields->id)->get();
		if($item == true) {
			return View::make('Edit')
				->with('item', $item)
				->with('fields', $fields);
		} else {
			return View::make('404');
		}
	}

	public function updateItem() {
		$update_Item = Item::updateItem(Input::all());
		return $update_Item;
	}

}