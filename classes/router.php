<?php

class Router {

	private function __construct() {}

	public static function call($url, $default_controller = 'home', $default_method = 'index') {
		$parts = explode('/', $url);
		$controller = !empty($parts[0])? $parts[0] : $default_controller;
		$method = !empty($parts[1])? $parts[1] : $default_method;
		$args = array_slice($parts, 2);

		//check if controller exists and load it;
		$className = 'Controller\\'.$controller;
		$AL = Autoloader::init();
		if (!$AL->loadClass($className))
			return false;
		$Object = new $className();

		//check if method exists
		if (!method_exists($Object, $method))
			return false;

		return call_user_func_array(array($Object, $method), $args);
	}

}
