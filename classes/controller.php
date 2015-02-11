<?php

class Controller {

	public $View = null;
	public $DB = null;

	public function __construct() {
		$this->View = \View::getInstance();
		$this->DB = \DB::getInstance();
	}

}
