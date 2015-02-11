<?php

namespace Controller;
class Backend extends \Controller {

	public function before() {
        if (!isset($_SESSION['auth'])) {
            $this->redirect('auth/login');
        }
    }

}
