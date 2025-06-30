<?php

class App {

	public static function ini() {

		header('Content-type: text/html; charset=UTF-8');

		//DEFINICOES DO PHP.INI
		error_reporting(E_ALL);
		ini_set('display_errors', 0);
		ini_set('memory_limit', '999M');

		//CONSTANTES
		define('DIR', dirname( dirname( __FILE__ ) ));

		$servidor = $_SERVER['SERVER_NAME'];

		if(stristr($servidor, 'premierpet.tnsistemas.com.br')) {
			define('URL_EMAIL', '/');
		} else {
			define('URL_EMAIL', '/');
		}

		define('URL', URL_EMAIL . 'adm/');
		define('PASTA_CONTROLLER', 'controllers');
		define('PASTA_CONF', 'config');
		define('PASTA_LANGUAGE', 'language');
		define('PASTA_LIBS', 'libs');
		define('PASTA_MODELS', 'models');
		define('PASTA_VIEWS', 'views');
		define('PASTA_UPLOADS', 'uploads');
		define('PASTA_API', 'api');
		define('PAGINA_INICIAL', 'login');
		define('API', 'bootstrap');
		define('TEMPLATE', 'default');
		define('TOKEN', '_@2864!YazXBB75%4$33...');
		define('COOKIE', true);
		define('COOKIE_TIME', 560);
		define('COOKIE_PATH', URL . 'login');
		define('PASTA_FILE', serialize(array('news', 'galery', 'movies', 'attachement', 'others')));
		define('CLASSES', serialize(array('Bootstrap', 'Controller', 'Model', 'Func', 'Cookie', 'Session', 'Language', 'View', 'Database')));
		define('LIMITE', 1400);


		//SITUAÇÃO
		define("CHAVE_NAO_ENVIADA", "Chave não enviada");
		define("CHAVE_NAO_ATRELADA_AO_EMAIL", "Chave não atrelada ao e-mail");
		define("CHAVE_REENVIADA_E_JA_UTILIZADA", "Chave reenviada e já utilizada");
		define("CHAVE_REENVIADA_E_NAO_UTILIZADA", "Chave reenviada e não utilizada");
		define("CHAVE_JA_UTILIZADA", "Chave já utilizada");
		define("CHAVE_ENVIADA_E_NAO_UTILIZADA", "Chave enviada e não utilizada");

		// REQUISITOS
		require PASTA_CONF . '/database.php';
		foreach(unserialize(CLASSES) as $class) {

			if ($class == "Cookie") {
				if(COOKIE) {
					require PASTA_LIBS . '/' . $class . '.php';
				}
			} else {
				require PASTA_LIBS . '/' . $class . '.php';
			}

		}
	}

}