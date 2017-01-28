<?php

class DB {

	private static $_instance = null;
	private $_pdo = null;

	private function __construct() {
		$this->_pdo = new PDO(
			'mysql:dbname='.Config::DB_NAME.';'.Config::DB_HOST.';charset=utf8',
			Config::DB_USER, Config::DB_PASS
		);
		$this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public static function getInstance() {
		if (self::$_instance == null)
			self::$_instance = new self();
		return self::$_instance;
	}

	public function __call($method, $args) {
		return call_user_func_array(array($this->_pdo, $method), $args);
	}

	public function execute($sql, array $params = null) {
		$stmt = $this->_pdo->prepare($sql);
		$stmt->execute($params);
		return $stmt;
	}

}
