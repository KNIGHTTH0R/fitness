<?php

namespace Controller;
class Logout extends \Controller {

	public function index() {
		unset($_SESSION['iduser']);
		header('Location: http://'.$_SERVER['HTTP_HOST'].\Config::BASEURL);
	}

}
