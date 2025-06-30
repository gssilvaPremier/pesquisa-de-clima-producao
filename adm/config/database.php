<?php
$servidor = $_SERVER['SERVER_NAME'];

if(stristr($servidor, 'premierpet.tnsistemas.com.br')) {
	define('DB_TYPE', 'mysql');
	define('DB_HOST', 'localhost');
	define('DB_PORT', '3306');
	define('DB_BASE', 'premierpet_spc_v2');
	define('DB_USER', 'premierpet_spc2023_v2');
	define('DB_PASS', 'ypbF[ywZIrE!');
	define('DB_CONECTION', '');
} else {
	define('DB_TYPE', 'mysql');
	define('DB_HOST', 'db_v2');
	define('DB_PORT', '3306');
	define('DB_BASE', 'premierpet_spc_v2');
	define('DB_USER', 'premierpet_spc2023_v2');
	define('DB_PASS', 'ypbF[ywZIrE!');
	define('DB_CONECTION', '');
}