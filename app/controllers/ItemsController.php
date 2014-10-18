<?php

class ItemsController extends BaseController {

<<<<<<< HEAD
=======

>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
	public function addItem() {
		$item = Item::registerItem(Input::all());
		return $item;
	}

	public function showItem($id) {
<<<<<<< HEAD
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
=======
		//Search Item by id
		$item = Item::find($id);
		$locations = Location::lists('name','id');

		if($item == true) {
			return View::make('Item')
				->with('item', $item)
				->with('devices', $item->devices)
				->with('locations', $locations)
				->with('device_location', $item->devices);
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
		} else {
			return View::make('404');
		}
	}

	public function showTracks($id) {
<<<<<<< HEAD
		$item = Item::find($id);
		$devices = Device::where('item_id', $id)->get();
=======
		//Find Item where id = $id
		$item = Item::find($id);
		//Get Device where item_id = $id
		$devices = Device::where('item_id', $id)->get();
		//Get all Location
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
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
<<<<<<< HEAD
		$item = Item::find($id);
		$fields = Field::where('item_id', $id)->get();
		//$infos = Info::where('field_id', $fields->id)->get();
=======
		//Get Item where id = $id
		$item = Item::find($id);
		//Get All Fields where item_id = $id
		$fields = Field::where('item_id', $id)->get();

>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
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
<<<<<<< HEAD

}
=======
}


>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
