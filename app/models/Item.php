<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Item extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	use SoftDeletingTrait;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	//protected $table = 'inv_items';
	protected $softDelete = true;
	protected $dates = ['deleted_at'];
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $fillable = array(
		'name',
		'item_data',
		'label'
	);

	public function field() {
		return $this->hasMany('Field');
	}

	public function device() {
		return $this->hasMany('Device');
	}

	public function audit() {
		return $this->hasMany('Audit');
	}

	public static function registerItem($data) {

		$values = array(
			'name' => $data['itemTb'],
			'item_data' => $_POST["mytext"]
		);

		//rules
		$rules =array(
			'name' => 'required|unique:items,name',
			'item_data' => 'required'
		);

		$validation = Validator::make($values, $rules);

		//check if validation successful
		if($validation->fails()) {
			return Redirect::back()
				->withErrors($validation);
		} else {
			//add new item in item_tbl
			$item = new Item;
			$item->name = $data['itemTb'];
			$item->save();
			//get name and id
			$item_name = $item->name;
			$insertedId = $item->id;
			//save actions in audit
			$audits = new Audit;
			$audits->history = Auth::user()->firstname ." ". Auth::user()->lastname . " added the item " . $item_name . " on the database.";
			$audits->save();

			$audit_history = '';
			$audits = new Audit;

			foreach($_POST["mytext"] as $labelField) {
				if($labelField != '') {
					$field = new Field;
					//$field = new Item;
					$field->item_id = $insertedId;
					$field->item_label = $labelField;
					$field->save();
					$field_name = $field->item_label;
					//Separate each field with comma ,
					$field_array = implode(", ", array_values(($_POST["mytext"])));

					//Save the added field on the history.
					if( $audits->history == $audit_history OR $audits->history != $audit_history) {
						$audit_history = $audits->history;
						$audits->history = Auth::user()->firstname ." ". Auth::user()->lastname . " sets the field " . $field_array . " on the item " . $item_name .".";
						$audits->save();
					}
				}
			}
			return Redirect::back()
					->with('message', "Item has been successfully saved on the database along with it's fields.");
		}
	}

	public static function updateItem($data) {
		$audit_history = '';
		$changesApplied = 0;
		
		//Update fields on a specific item
		foreach($data as $key=>$value) {
			if ($value != '') {
				if(strpos($key,'field') !== false) {
					//get id (field-1)
					$field_info = explode("-", $key);
					$id = $field_info[1];
					//Search, and update the field on the database
					$field = Field::find($id);
					//Get first the label before Update
					$field_old_label = $field->item_label;
					$field->item_label = $value;
					$field->save();
					//Get the latest field Value
					$field_new_label = $field->item_label;

					//Save the updates happened on each fields on the history.
					$audits = new Audit;
					$searchId = Field::where('id', $id)->get();

					foreach ($searchId as $fieldValues) {
						if( $audits->history == $audit_history OR $audits->history != $audit_history) {
							if ($field_old_label != $field_new_label) {
								$audit_history = $audits->history;
								$audits->history = Auth::user()->firstname ." ". Auth::user()->lastname . " changed the field " . $field_old_label . " to " . $fieldValues->item_label ." of the item ".$_POST["iName"].".";
								$audits->save();
								$changesApplied++;
							}
						}
					}
				}
			}
		}

		//Add fields on a specific item
		if (isset($_POST["mytext"]) != '') {
			foreach($_POST["mytext"] as $labelField) {
				if ($labelField != '') {
					$field = new Field;
					$field->item_id = $_POST["iId"];
					$field->item_label = $labelField;
					$field->save();

					$newField = $field->item_label;

					$audit_history = '';
					$audits = new Audit;
					//Save the added field on the History
					if( $audits->history == $audit_history OR $audits->history != $audit_history) {

						$audit_history = $audits->history;
						$audits->history = Auth::user()->firstname ." ". Auth::user()->lastname . " Added a new " . $newField . " field on the item ".$_POST["iName"].".";
						$audits->save();
					$changesApplied++;
					}
				}
			}
			
		}
		if ($changesApplied != 0) {
			return Redirect::back()->with('message', 'Changes on Fields was successful.');
		} else {
			return Redirect::back()->with('message', 'Nothing were applied.');
		}
	}
}