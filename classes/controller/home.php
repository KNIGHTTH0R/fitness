<?php

namespace Controller;
class Home extends \Controller {

	public function index() {
		$this->redirect('event');
	}

}
