<?php

class Session {	
	
	public static function init() {
		@session_start();
		@session_cache_expire(180000);
	}
	
	public static function set($key, $value) {
		$_SESSION[$key] = $value;
	}
	
    public static function get($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return null; // Ou outra ação apropriada, como retornar um valor padrão.
        }
    }

	
	public static function onDestroy() {
		session_destroy();
	}
	
	public static function onUnset($key) {
		unset($_SESSION[$key]);
	}
		
	
}


?>