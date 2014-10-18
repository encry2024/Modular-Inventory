<?php

class ItemsController extends BaseController {

	public function addItem() {
		$item = Item::registerItem(Input::all());
		return $item;
	}

	public function showItem($id) {
		//Search Item by id
		$item = Item::find($id);
		$locations = Location::lists('name','id');

		if($item == true) {
			return View::make('Item')
				->with('item', $item)
				->with('devices', $item->devices)
				->with('locations', $locations)
				->with('device_location', $item->devices);
		} else {
			return View::make('404');
		}
	}

	public function showTracks($id) {
		//Find Item where id = $id
		$item = Item::find($id);
		//Get Device where item_id = $id
		$devices = Device::where('item_id', $id)->get();
		//Get all Location
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
		//Get Item where id = $id
		$item = Item::find($id);
		//Get All Fields where item_id = $id
		$fields = Field::where('item_id', $id)->get();
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
