<?php

namespace Controller;
class Backend extends \Controller {

	public function before() {
        if (!$this->isAuth()) {
            $this->redirect('auth/login');
        }
    }

}
