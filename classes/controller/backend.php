<?php

namespace Controller;
class Backend extends \Controller {

	protected $types = array('customer', 'coach', 'admin');

	public function before() {
        $isAuth = $this->forceAuth();
		if (!in_array($isAuth['type'], $this->types)) {
			\Message::add('You have no permission to access this site');
			$this->redirect('auth/login');
		}
    }

}
