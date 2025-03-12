<?php
$servidor = $_SERVER['SERVER_NAME'];

if(stristr($servidor, 'premierpet.tnsistemas.com.br')) {
	define('DB_TYPE', 'mysql');
	define('DB_HOST', 'localhost');
	define('DB_PORT', '3306');
	define('DB_BASE', 'premierpet_spc');
	define('DB_USER', 'premierpet_spc2023');
	define('DB_PASS', 'ypbF[ywZIrE!');
	define('DB_CONECTION', '');
} else {
	define('DB_TYPE', 'mysql');
	define('DB_HOST', 'db_new');
	define('DB_PORT', '3306');
	define('DB_BASE', 'premierpet_spc');
	define('DB_USER', 'premierpet_spc2023');
	define('DB_PASS', 'ypbF[ywZIrE!');
	define('DB_CONECTION', '');
}