<?php

class AuditController extends BaseController {

	public function trackAll() {
		$retrieveAudits = Audit::getAudits();

		return $retrieveAudits;
	}
}