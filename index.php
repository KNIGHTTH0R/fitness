<?php

//load config and set error reporting
require_once __DIR__.'/config.php';
error_reporting(Config::DEBUG? E_ALL : 0);
ini_set('display_errors', Config::DEBUG? 1 : 0);

//init autoloader
require_once __DIR__.'/classes/autoloader.php';
Autoloader::init();

//start session
session_start();

//get view
$View = View::getInstance();

$content = Router::call(isset($_GET['request'])? $_GET['request'] : '');

//output html
$View->assign(array(
	'title' => 'fitness-lounge.lu',
	'lang' => 'fr',
	'content' => $content
));
$View->display('main.tpl');
