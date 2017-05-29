<?php

class NiceClass {
	
	protected $DB;

	function __construct($DB) {
		$this->DB = $DB;
	}

	function getNiceThing($niceThingID) {
		if (!$niceThingID) return false;

		$sql = "SELECT * FROM niceThings WHERE niceThingID={$niceThingID}";

		$niceThing = $this->DB->GetRow($sql);

		if (!$niceThing) return false;
		
		$niceThing['fullName'] = $this->getFullName($niceThing);
		$niceThing['isFine'] = true;

		return $niceThing;
	}

	function getFullName($niceThing) {
		return $niceThing['firstName']." ".$niceThing['surName'];
	}

}
