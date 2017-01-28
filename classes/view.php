<?php

class View {

	private static $_instance = null;
	private $_smarty = null;

	private function __construct() {
		$this->_smarty = new \Smarty();
		$this->_smarty->setTemplateDir(Config::ROOT.'/templates');
		$this->_smarty->setCompileDir(Config::ROOT.'/var/view/templates_c');
		$this->_smarty->setCacheDir(Config::ROOT.'/var/view/cache');
		$this->_smarty->error_reporting = E_ALL & ~E_NOTICE;
	}

	public static function getInstance() {
		if (self::$_instance == null)
			self::$_instance = new self();
		return self::$_instance;
	}

	public function __call($method,$args) {
		return call_user_func_array(array($this->_smarty, $method), $args);
	}

}
