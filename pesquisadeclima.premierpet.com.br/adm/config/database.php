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
	define('DB_HOST', '127.0.0.1');
	define('DB_PORT', '3306');
	define('DB_BASE', 'premierpet_spc');
	define('DB_USER', 'premierpet_spc2023');
	define('DB_PASS', 'ypbF[ywZIrE!');
	define('DB_CONECTION', '');
}