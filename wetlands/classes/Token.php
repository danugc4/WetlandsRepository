<?php
class Token {

	public static function generate() { // method that generates a token
		return Session::put(Config::get('session/token_name'), md5(uniqid())); // put a token into the session
	}

	public static function check($token) { //check if a token exists
            // check if the token in the session is the same as the token in the form
		$tokenName = Config::get('session/token_name'); 
		// delete if conditions are met
		if(Session::exists($tokenName) && $token === Session::get($tokenName)) {
			Session::delete($tokenName);
			return true;
		}
		
		return false;
	}
}

