<?php

//load config and set error reporting
require_once __DIR__.'/config.php';
error_reporting(Config::DEBUG? E_ALL : 0);
ini_set('display_errors', Config::DEBUG? 1 : 0);

//init autoloader
require_once __DIR__.'/classes/autoloader.php';
Autoloader::init();

//init composer autoloader
require_once __DIR__.'/vendor/autoload.php';

//start session
session_set_cookie_params(0, Config::BASEURL);
session_start();

//get view
$View = View::getInstance();

$content = Router::call($_SERVER['REQUEST_URI']);

//output html
$View->assign(array(
	'title' => 'fitness-lounge.lu',
	'lang' => 'fr',
	'menu' => Router::call('menu'),
	'content' => $content,
	'message' => \Message::render()
));
$View->display('main.tpl');
