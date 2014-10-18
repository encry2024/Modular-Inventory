<?php 

class Info extends Eloquent {

	protected $fillable = array(
		'dev_id',
		'label_id',
		'value'
	);

	public function device() {
		return $this->belongsTo('Device');
	}

	public function field() {
		return $this->belongsTo('Field');
	}

	public function audit() {
		return $this->hasMany('Audit');
	}
}