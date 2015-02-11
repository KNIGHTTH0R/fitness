<?php

namespace Controller;
class Home extends \Controller {

	public function index() {
		$this->View->assign(array(
			'addlink' => \Config::BASEURL.'form',
			'search' => \Router::call('thesis/search')
		));
		return $this->View->fetch('home/index.tpl');
	}

}

?>