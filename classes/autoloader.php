<?php

class Autoloader {

	private static $_instance = null;

	private function __construct() {
		spl_autoload_register(array($this, 'loadClass'));
	}

	public static function init() {
		if (self::$_instance == null)
			self::$_instance = new self();
		return self::$_instance;
	}

	public function loadClass($className) {
		$filename = Config::ROOT.'/classes/'.str_replace('\\', '/', strtolower($className).'.php');
		if (!is_file($filename))
			return false;
		require_once $filename;
		return true;
	}

}
