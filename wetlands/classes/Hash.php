<?php
class Hash {
    // make a hash
	public static function make($string, $salt = '') { // provide a string and add a salt
		return hash('sha256', $string . $salt); // plain text string, add salt and then hash it
	}
        
        // generate a salt of a particular
	public static function salt($length) { 
		return mcrypt_create_iv($length);
	}
        
        // make a unique hash
	public static function unique() {
		return self::make(uniqid()); 
	}
}