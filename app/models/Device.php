<?php 

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Device extends Eloquent {

	
	use SoftDeletingTrait;

	protected $dates = ['deleted_at'];
	protected $softDelete = true;
	protected $fillable = array(
		'item_id',
		'name'
	);

	public function item() {
		return $this->belongsTo('Item')->withTrashed();
	}

	public function info() {
		return $this->hasMany('Info');
	}

	public function location() {
		return $this->belongsTo('Location');
	}

	public function devicelog() {
		return $this->hasMany('DeviceLog');
	}

	public function audit() {
		return $this->hasMany('Audit');
	}

	public static function registerDevice($data) {
		$values = array(
			'item_id' => $data["itemId"],
			'name' => $data['mydevice']
		);

		//rules
		$rules =array(
			//'value' => 'required',
			'item_id' => 'required',
			'name' => 'required|unique:devices,name'
		);

		$validation = Validator::make($values, $rules);

		//check if validation successful
		if($validation->fails()) {
			return Redirect::back()
				->withErrors($validation);
		} else {

			//add new device in device_tbl
			$device = new Device();
			$device->item_id = $data["itemId"];
			$device->name = trim($data['mydevice']);
			$device->status = "Normal";
			$device->availability = "Available";
			$device->save();

			//Get Device ID, Name from Inserted Device
			$insertedDevId = $device->id;
			$insertedDeviceName = $device->name;

			//Get Item Name
			$find_item = Item::find($data["itemId"]);
			$item_name = $find_item->name;

			//Save action taken on Audit
			$audits = new Audit;
			$audits->history = Auth::user()->firstname ." ". Auth::user()->lastname . " added the " . $insertedDeviceName . " on the item " . $item_name .".";
			$audits->save();

			//loop through field arrays
			foreach($data as $key=>$value) {
				if(strpos($key,'field') !== false) {
					//get id (field-1)
					$field_info = explode("-", $key);
					$id = $field_info[1];

					//save in database
					$info = new Info();
					$info->device_id = $insertedDevId;
					$info->field_id = $id;
					$info->value = $value;
					$info->save();
					$field_id = $info->field_id;

					$audits = new Audit();
					$audit_history = $audits->history;
					$field = Field::where('id', $id)->get();
					$info = Info::where('field_id', $field_id)->get();
					foreach ($field as $field) {
						foreach ($info as $fields_info) {
							if( $audits->history == $audit_history OR $audits->history != $audit_history) {
								$audit_history = $audits->history;
								$audits->history = Auth::user()->firstname ." ". Auth::user()->lastname . " has set the Information " .$fields_info->value  . " on the ". $insertedDeviceName . "'s " . $field->item_label . " Field. ";
								$audits->save();
							}
						}
					}
				} else {
					continue;
				}
			}
			return Redirect::back();
		}
	}

	//UPDATE DEVICE INFORMATION

	public static function update_device_infos($data) {
		$audit_history = '';
		$changesApplied = 0;
		foreach($data as $key=>$value) {
			if(strpos($key,'field') !== false) {
				//get id (field-1)
				$field_info = explode("-", $key);
				$id = $field_info[1];

				//save in database
				$info = Info::find($id);
				$info_OldValue = $info->value;
				$info->value = $value;
				$info->save();

				$info_NewValue = $info->value;

				$audits = new Audit();
				$searchInfo = Info::where('id', $id)->get();

				$device = Device::find($_POST["deviceId"]);
				$deviceName = $device->name;

				foreach ($searchInfo as $infoValues) {
					if ($info_OldValue != $info_NewValue) {
						$audit_history = $audits->history;
						$audits->history = Auth::user()->firstname ." ". Auth::user()->lastname . " changed the information " . $info_OldValue . " to " . $infoValues->value ." of the device ".$deviceName.".";
						$audits->save();
						$changesApplied++;
					} else {
						$audit_history = $audits->history;
						$audits->history = Auth::user()->firstname ." ". Auth::user()->lastname . " made no changes on ".$infoValues->value." Information of the Device: ".$deviceName.".";
						$audits->save();
					}
				}
			} else {
				continue;
			}
		}
		if ($changesApplied != 0) {
			return Redirect::back()
				->with('message', 'Device Information has been changed.');
		} else {
			return Redirect::back()
				->with('message', 'No changes happened.');
		}
	}

	//CHANGE DEVICE STATUS

	public static function changeStatus($data) {
		$device = Device::find($data["devi_Id"]);
		$device->status = $data["status"];
		$device->comment = $data["commentArea"];
		if ($device->status == 'Normal') {
			$device->availability = 'Available';
		}
		else {
			$device->availability = 'Not Available';
		}
		$device->save();
		$device_name = $device->name;
		$device_comment = $device->comment;
		$device_status = $device->status;

		$audits = new Audit;
		$audits->history = Auth::user()->firstname ." ". Auth::user()->lastname . " has set the Device ". $device_name ." status to ". $device_status .". Comment: ".$device_comment.".";
		$audits->save();

		return Redirect::back()
						->with('message', 'Device status updated.');
	}

	//RETRIEVE TRACKS

	public static function retrieveTrack($id) {
		# code...
		//Search device id
		$device = Device::find($id);

		//Get Item by the Device's item_id
		$item = Item::find($device->item_id);
		$itemId = $item->id;

		//Get all the Location of a specific Device
		$device_location = DeviceLog::where('device_id', $id)->orderby('created_at', 'desc')->paginate(20);

		//Get Devices with Location
		$devices = Device::with('location')->where('id', $id)->get();
		
		//Get Information value on Field
		$fields = Info::with('field')->where('device_id', $device->id)->get();

		$locations = Location::whereNotIn('id', function($query) use ($itemId) {
			    $query->select(['location_id']); 
			    $query->from('devices');
			    $query->where('item_id', $itemId); 
				})->get();

		if($device == true) {
			return View::make('trackdevice')
				->with('devices', $device->item_id)
				->with('device_id', $device->id)
				->with('device_name', $device->name)
				->with('device_location', $device_location)
				->with('device', $device)
				->with('dvc', $devices)
				->with('item', $item)
				->with('fields', $fields)
				->with('locations', $locations);
		} else {
			return View::make('404');
		}
	}


	public static function action_AssignDevice($data) {
		$values = array(
			'device_id' => $data["idTb"],
			'location_id' => $data["locationList"]
		);

		//rules
		$rules = array(
			'device_id' => 'required',
			'location_id' => 'required'
		);

		$validation = Validator::make($values, $rules);

		//check if validation successful
		if($validation->fails()) {
			return Redirect::back()
				->withErrors($validation);
		} else {
			//Add Device and location on Pivot Table
			$deviceLog = new DeviceLog;
			$deviceLog->device_id = $_POST["idTb"];
			$deviceLog->location_id = $data["locationList"];
			$deviceLog->action_taken = "assigned" ;
			$deviceLog->save();

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
		$getLocation_id = $device->location_id;
		$device->location_id = "0";
		$device->save();

		$device_name = $device->name;
		$device_id = $device->id;

		$getLocation = Location::find($getLocation_id);
		$getLocation_name = $getLocation->name;
		$getLocation_Id = $getLocation->id;

		$deviceLog = new DeviceLog;
		$deviceLog->device_id = $device_id;
		$deviceLog->location_id = $getLocation_Id;
		$deviceLog->action_taken = "dissociated" ;
		$deviceLog->save();

		$audits = new Audit;
		$audits->history = Auth::user()->firstname ." ". Auth::user()->lastname ." has dissociated the device ".$device_name." from Location ".$getLocation_name.".";
		$audits->save();

		return Redirect::back();
	}
}