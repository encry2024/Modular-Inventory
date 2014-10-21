<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class DeviceLocation extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	use SoftDeletingTrait;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'device_location';
	protected $softDelete = true;
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	protected $fillable = array(
		'location_id',
		'device_id'
	);

	public function audit() {
		return $this->hasMany('Audit');
	}

	public function device() {
		return $this->belongsTo('Device');
	}

	public function location() {
		return $this->belongsTo('Location');
	}

	public static function action_Register_Device_Location($data) {

		$values = array(
			'device_id' => $data["idTb"]
		);

		//rules
		$rules = array(
			'device_id' => 'required'
		);

		$validation = Validator::make($values, $rules);

		//check if validation successful
		if($validation->fails()) {
			return Redirect::back()
				->withErrors($validation);
		} else {
			//Add Device and location on Pivot Table
			$device_location = new DeviceLocation;
			$device_location->location_id = $data["locationList"];
			$device_location->device_id = $_POST["idTb"];
			$device_location->item_id = $_POST["itemID"];
			$device_location->save();

			//Get Device Name and Id
			$device = Device::find($_POST["idTb"]);
			$device_name = $device->name;
			$deviceId = $device->id;

			//Get Location: Name, ID
			$locations = Location::find($data["locationList"]);
			$locationName = $locations->name;
			$getLocationId = $locations->id;
			
			//Save Location ID on Device and availability to Assigned
			$devices = Device::find($_POST["idTb"]);
			$devices->availability = "Assigned";
			$devices->location_id = $getLocationId;
			$devices->save();

			//Save the action taken to Audit
			$audits = new Audit;
			$audits->history = Auth::user()->firstname ." ". Auth::user()->lastname ." has assigned the device ".$device_name . " to the location ". $locationName .".";
			$audits->save();

			return Redirect::back()
				->with('message', 'The device '.$device_name.' has been assigned to '. $locationName .'.')
				->with('locations_name', $locationName);
		}
	}

	public static function unAssignDevice($data) {
		$device = Device::find($data["idTb"]);
		$device->availability = "Available";
		$device->location_id = "0";
		$device->save();

		$device_name = $device->name;
		$device_id = $device->id;

		foreach (DeviceLocation::where('device_id', $device_id)->get() as $location_id) {
			$getLocation_id = $location_id->location_id;
		}

		$getLocation = Location::find($getLocation_id);
		$getLocation_name = $getLocation->name;

		$audits = new Audit;
		$audits->history = Auth::user()->firstname ." ". Auth::user()->lastname ." has dissociated the device ".$device_name." from Location ".$getLocation_name.".";
		$audits->save();

		return Redirect::back();
	}
}