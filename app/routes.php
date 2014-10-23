<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

#GET
Route::get('login', 'LoginController@showLogin');
Route::get('logout', function() {
	Auth::logout();
	return Redirect::to('login');
});

Route::get('Device/delete/{id}', function($id) {
	//Search ID then get item_id, and name before delete
	$device = Device::find($id);
	$deviceItemId = $device->item_id;
	$device_name = $device->name;
	//Delete the device
	$device->delete();
	$deviceID = $device->id;
	//Save action to history
	$audits = new Audit;
	$audits->history = Auth::user()->firstname ." ". Auth::user()->lastname . " has deleted the device ".$device_name." permanently.";
	$audits->save();

	return  Redirect::to('Item/'.$deviceItemId)
		->with('deleteMessage', 'Device deleted');
});

Route::get('Field/delete/{id}', function($id) {

	$field = Field::find($id);
	$fieldItemId = $field->item_id;
	$field_name = $field->item_label;

	$getItem = Item::where('id', $fieldItemId)->first();
	$itemName = $getItem->name;

	$getInfo = Info::where('field_id', $id)->get();

	foreach ($getInfo as $value) {
		$audits = new Audit;
		$audits->history = Auth::user()->firstname ." ". Auth::user()->lastname . " has deleted the field " .$field_name." and its field(s): ".$value->value." on the item ". $itemName ." permanently.";
		$audits->save();
	}

	foreach($getInfo as $info) {
		$info->delete();
	}
	$field->delete();
	return Redirect::back()
			->with('deleteMessage', 'Field '.$field->item_label.' has been deleted.');
});

Route::get('Item/delete/{id}', function($id) {
	$item = Item::find($id);
	$item_name = $item->name;
	$audits = new Audit;
	$audits->history = Auth::user()->firstname ." ". Auth::user()->lastname . " has deleted the Item " .$item_name." permanently.";
	$audits->save();
	$item->delete();

	return  Redirect::to('/')
		->with('deleteMessage', 'Item deleted');
});
Route::get('/register', 'RegisterController@showRegister');
Route::get('/', 'ProfileController@showProfile');

Route::get('Item/{id}', function($id) {

	$item = Item::find($id);
	$device = Device::where('item_id', $id)->get();
	$locations = DB::select('SELECT * FROM inv_locations WHERE id NOT IN (SELECT location_id FROM inv_devices WHERE item_id = '.$id.')');
	$devices = Device::with('location')->where('item_id', $id)->get();
	
	if(count($device) != 0) {
		return View::make('Item')
			->with('item', $item)
			->with('devices', $item->devices)
			->with('locations', $locations)
			->with('device_location', $devices)
			->with('dvce', $device);
	} else {
		return View::make('Item')
			->with('item', $item)
			->with('devices', $item->devices)
			->with('device_location', $devices)
			->with('dvce', $device);
	}
});
Route::get('Device/{id}', 'DeviceController@showDevice');
Route::get('Device/Track/{id}', 'DeviceController@showTrack');
Route::get('All/Track', 'AuditController@trackAll');
Route::get('Track/{id}', 'DeviceController@showTracks');
Route::get('Edit/{id}', 'ItemsController@editItem');
Route::get('/Location', 'LocationController@viewLocation');
Route::get('changePassword', 'UserController@showChangePass');

#POST
Route::post('authenticate', 'LoginController@authenticate');
Route::post('registeruser', 'RegisterController@registerUser');
Route::post('additem','ItemsController@addItem');
Route::post('adddevice', 'DeviceController@addDevice');
Route::post('addlocation', 'LocationController@addLocation');
Route::post('updateDevice', 'DeviceController@updateDevInfo');
Route::post('updateitem', 'ItemsController@updateItem');
Route::post('assign', 'DeviceController@assignDevice');
Route::post('unassign', 'DeviceController@unassignDevice');
Route::post('changestatus', 'DeviceController@changeStatus');
Route::post('changepass', 'UserController@changeUserPass');
