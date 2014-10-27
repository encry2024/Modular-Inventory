<?php

class Location extends Eloquent {

	protected $fillable = array(
		'id',
		'name'
	);

	public function device() {
		return $this->hasMany('Device');
	}

	public function audit() {
		return $this->hasMany('Audit');
	}

	public function devicelog() {
		return $this->hasMany('DeviceLog');
	}

	public static function create_location($data) {
		$values = array(
			'name' => $data['locationTb']
		);

		//rules
		$rules =array(
			'name' => 'required|unique:locations,name'
		);

		$validation = Validator::make($values, $rules);

		//check if validation successful
		if($validation->fails()) {
			return Redirect::back()
				->withErrors($validation);
		} else {

			if ($data['locationTb'] != '') {
				$location = new Location;
				$location->name = trim($data['locationTb']);
				$location->save();

				$location_name = $location->name;

				$audits = new Audit;
				$audits->history = Auth::user()->firstname ." ". Auth::user()->lastname ." has created the location ".$location_name . ".";
				$audits->save();

				return Redirect::back();
			}
		}
	}

	public static function action_LocationName($data) {
		$audit_history = '';
		$changesApplied = 0;

		foreach($data as $key=>$value) {
			if(strpos($key,'location') !== false) {
				//get id (field-1)
				$location_info = explode("-", $key);
				$id = $location_info[1];

				//save in database
				$location = Location::find($id);
				$location_oldName = $location->name;
				$location->name = $value;
				$location->save();

				//get updated location name
				$location_newName = $location->name;

				$audits = new Audit();
				$searchInfo = Location::where('id', $id)->get();

				foreach ($searchInfo as $locationValue) {
					if ($location_oldName != $locationValue->name) {
						$audit_history = $audits->history;
						$audits->history = Auth::user()->firstname ." ". Auth::user()->lastname . " changed the Location name from " . $location_oldName . " to " . $locationValue->name .".";
						$audits->save();
						$changesApplied++;
					} else {
						$audit_history = $audits->history;
						$audits->history = Auth::user()->firstname ." ". Auth::user()->lastname . " made no changes on Location ".$locationValue->name.".";
						$audits->save();
					}
				}
			} else {
				continue;
			}
		}
		if ($changesApplied != 0) {
			return Redirect::back()
				->with('message', 'Location Name has been changed.');
		} else {
			return Redirect::back()
				->with('message', 'No changes happened.');
		}
	}
}