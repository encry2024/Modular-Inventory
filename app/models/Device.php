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
		return $this->belongsTo('Item');
	}

	public function info() {
		return $this->hasMany('Info');
	}

	public function location() {
		return $this->belongsTo('Location');
	}

	public function deviceLocations() {
		return $this->hasMany('DeviceLocation');
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
			$device->name = $data['mydevice'];
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
					$field = Field::where('id', $field)->get();
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

	public static function update_device_infos($data) {
		foreach($data as $key=>$value) {
			if(strpos($key,'field') !== false) {
				//get id (field-1)
				$field_info = explode("-", $key);
				$id = $field_info[1];

				//save in database
				$info = Info::find($_POST["deviceId"]);
				$info->field_id = $id;
				$info->value = $value;
				$info->save();

				$info_Id = $info->id;

				$audits = new Audit();
				$audits->username = Auth::user()->username;
				$audits->user_id = Auth::user()->id;
				$audits->info_id = $info_Id;
				$audits->save();
			} else {
				continue;
			}
		}
		return Redirect::back();
	}

	public static function changeStatus($data) {
		$device = Device::find($data["devi_Id"]);
		$device->status = $data["status"];
		$device->save();
		$device_name = $device->name;
		$device_status = $device->status;
		$audits = new Audit;
		$audits->history = Auth::user()->firstname ." ". Auth::user()->lastname . " has set the Device ". $device_name ." status to ". $device_status .".";
		$audits->save();

		return Redirect::back()
						->with('message', 'Device status updated.');
	}
}
///Device has 1 info.
///Info has many fields.