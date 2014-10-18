<?php

<<<<<<< HEAD

=======
>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
class Audit extends Eloquent {

	public static function getAudits() {
		$audits = Audit::distinct('history', 'created')->orderBy('created_at', 'desc')->get();

		return View::make('trackall')
				->with('audits', $audits);
	}
			
<<<<<<< HEAD
}
=======
}

>>>>>>> 3dca606b07226acb79874b6a530be05e7eb3f184
