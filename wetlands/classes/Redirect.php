<?php
class Redirect {
        //
	public static function to($location = null) {
                // check if location has been defined
		if($location) {
                        // if path is a number
			if(is_numeric($location)) {
				switch($location) { // swith statement and exit
					case 404:
						header('HTTP/1.0 404 Not Found');
						include 'includes/errors/404.php';
						exit();
					break;
				}
			} else {
                                // header location to location and exit
				header('Location: ' . $location);
				exit();
			}
		}
	}
}