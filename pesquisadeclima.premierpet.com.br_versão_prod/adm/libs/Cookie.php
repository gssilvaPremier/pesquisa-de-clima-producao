<?php

class Cookie {	
	
	public static function set($key, $value, $time, $path) {
		setcookie($key, $value, time() + $time, $path);
	}
	
	public static function get($key) {
		return $_COOKIE[$key];
	}
	
	public static function onDestroy() {
		session_set_cookie_params(-50);
	}
	
	public static function onUnset($key, $path) {
		setcookie($key, NULL, 0, $path);
	}
		
	
}


?>