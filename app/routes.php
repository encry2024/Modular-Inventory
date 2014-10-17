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
Route::get('logout', function(){
	Auth::logout();
	return Redirect::to('login');
});

Route::get('Device/delete/{id}', function($id)
{
	$device = Device::find($id);
	$device_name = $device->name;
	$device->delete();

	$deviceID = $device->id;

	$audits = new Audit;
	$audits->history = Auth::user()->firstname ." ". Auth::user()->lastname . " has deleted the device ".$device_name." permanently.";
	$audits->save();

	return  Redirect::back()
		->with('deleteMessage', 'Device deleted');
});

Route::get('Field/delete/{id}', function($id) {

	$field = Field::find($id);
	$fieldItemId = $field->item_id;
	$field_name = $field->item_label;
	

	$getItem = Item::where('id', $fieldItemId)->first ();
	$itemName = $getItem->name;

	$audits = new Audit;
	$audits->history = Auth::user()->firstname ." ". Auth::user()->lastname . " has deleted the field " .$field_name." on the item ". $itemName ." permanently.";
	$audits->save();
	$field->delete();
	return Redirect::back()
			->with('deleteMessage', 'Field '.$field->item_label.' has been deleted.');
});

Route::get('Item/delete/{id}', function($id)
{
	$item = Item::find($id);
	$item_name = $item->name;
	$audits = new Audit;
	$audits->history = Auth::user()->firstname ." ". Auth::user()->lastname . " has deleted the Item " .$item_name." permanently.";
	$audits->save();
	$item->delete();

	return  Redirect::back()
		->with('deleteMessage', 'Item deleted');
});
Route::get('/register', 'RegisterController@showRegister');
Route::get('/', 'ProfileController@showProfile');
Route::get('Item/{id}', 'ItemsController@showItem');
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
