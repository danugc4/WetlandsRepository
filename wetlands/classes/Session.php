<?php
class Session {
	public static function exists($name) { //check if a session exists
		return (isset($_SESSION[$name])) ? true : false; // if the name is set
	}

	public static function get($name) { //get the name in the session
		return $_SESSION[$name];
	}
	
	public static function put($name, $value) { // put a name into the session
		return $_SESSION[$name] = $value; 
	}

	public static function delete($name) { 
		if(self::exists($name)) { // delete the session if it exists
			unset($_SESSION[$name]);
		}
	}

        // method for flashing data. Flashes a messege, once refreshed messege is gone
	public static function flash($name, $string = null) { // name and contents of flash data
		if(self::exists($name)) { // if session exists
			$session = self::get($name); // get name of the session
			self::delete($name); // delete session
			return $session; // return session
		} else if ($string) {
			self::put($name, $string); // puts a specific value into name
		}
	}
}