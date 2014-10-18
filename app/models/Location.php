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

	public function deviceLocations() {
		return $this->hasMany('DeviceLocation');
	}

	public static function create_location($data) {
		if ($data['locationTb'] != '') {
			$location = new Location;
			$location->name = $data['locationTb'];
			$location->save();

			$location_name = $location->name;

			$audits = new Audit;
			$audits->history = Auth::user()->firstname ." ". Auth::user()->lastname ." has created the location ".$location_name . ".";
			$audits->save();

			return Redirect::back();
		}
<<<<<<< HEAD


	}
	
=======
	}
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
}