<?php

class Audit extends Eloquent {

	public static function getAudits() {
		$audits = Audit::distinct('history', 'created')->orderBy('created_at', 'desc')->get();

		return View::make('trackall')
				->with('audits', $audits);
	}
			
}

