<?php 

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Info extends Eloquent {

	use SoftDeletingTrait;
	protected $softDelete = true;
	protected $dates = ['deleted_at'];
	protected $fillable = array(
		'dev_id',
		'label_id',
		'value'
	);

	public function device() {
		return $this->belongsTo('Device');
	}

	public function field() {
		return $this->belongsTo('Field')->withTrashed();
	}

	public function audit() {
		return $this->hasMany('Audit');
	}
}