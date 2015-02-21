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

	public function forceAuth() {
		$isAuth = $this->isAuth();
		if (!$isAuth) {
			$_SESSION['request'] = $_GET['request'];
            $this->redirect('auth/login');
			return false;
        }
		return $isAuth;
	}

	public function getUserType() {
		$isAuth = $this->isAuth();
		if (!$isAuth)
			return false;
		return $isAuth['type'];
	}

}
