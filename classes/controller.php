<?php

class Controller {

	public $View = null;
	public $DB = null;

	public function __construct() {
		$this->View = \View::getInstance();
		$this->DB = \DB::getInstance();
	}

	public function redirect($url = '') {
		header('Location: http://'.$_SERVER['HTTP_HOST'].\Config::BASEURL.$url);
		exit;
	}

	public function isAuth() {
		if (!isset($_SESSION['auth']))
			return false;
		return $_SESSION['auth'];
	}

}
