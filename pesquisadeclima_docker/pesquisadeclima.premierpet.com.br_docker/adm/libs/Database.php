<?php

class DataBase extends PDO {
	
	public function __construct() {
		try{
			parent::__construct(DB_TYPE.':host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_BASE.';user='.DB_USER.';password='.DB_PASS);
		} catch(PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
			exit;
		}
	}
}