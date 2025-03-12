<?php

class Language {
	
	function __construct() {}
	
	public function write($name) {
		require PASTA_LANGUAGE . '/' . $name . '.php';
	}
	
}

?>