<?php

namespace Controller;
class Backend extends \Controller {

	public function before() {
        $this->forceAuth();
    }

}
