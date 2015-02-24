<?php
session_start();

// Create a global configuration
$GLOBALS['config'] = array(
	'mysql' => array(
		'host' 		=> 'localhost',
		'username' 	=> 'mydb1831gc',
		'password' 	=> 'pu5mih',
		'db' 		=> 'mydb1831'
	),
	'remember' => array(
		'cookie_name'	=> 'hash',
		'cookie_expiry' =>  604800
	),
	'session' => array(
		'session_name'	=> 'user',
		'token_name'	=> 'token'
	)
);

//define('PATH', dirname(__DIR__));

// Autoload classes using anonymous function
spl_autoload_register(function ($class) {
	require_once dirname(__DIR__).'/classes/' . $class . '.php';
});

// Include functions
require_once dirname(__DIR__).'/functions/sanitize.php';

// Check for users that have requested to be remembered
if(Cookie::exists(Config::get('remember/cookie_name'))) {
	$hash = Cookie::get(Config::get('remember/cookie_name'));
	$hashCheck = DB::getInstance()->get('user_session', array('hash', '=', $hash));

	if(!$hashCheck) {
		Cookie::delete(Config::get('remember/cookie_name'));
	} else {
		if($hashCheck->count()) {
			$user = new User($hashCheck->first()->user_id);
			$user->login();
		}
	}
}