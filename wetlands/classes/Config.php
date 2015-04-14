<?php
class Config {
	public static function get($path = null) {
		if($path) {//does myaql exist in config
			$config = $GLOBALS['config'];
			$path = explode('/', $path);

			foreach($path as $bit) {
				if(isset($config[$bit])) {
					$config = $config[$bit];
				}
			}

			return $config;//return host
		}

		return false;
	}
}