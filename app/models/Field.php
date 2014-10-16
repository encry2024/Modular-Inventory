<?php 

class Field extends Eloquent {

	public function item() {
		return $this->belongsTo('Item');
	}

	public function audit() {
		return $this->hasMany('Audit');
	}

	public function info() {
		return $this->hasMany('Info');
	}
}