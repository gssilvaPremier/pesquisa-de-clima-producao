<?php
@session_cache_expire(45);
@session_start();

$servidor = $_SERVER['SERVER_NAME'];

//if(stristr($servidor, 'premierpet.pesquisa')) {
//    $banco = new Banco('localhost', 5432, 'root', 'root', 'premier_pesquisa_2023', 'SQL_ASCII');
//    define('URL', '/');
//} else {
    $banco = new Banco('127.0.0.1', 3306, 'premierpet_spc2023', 'ypbF[ywZIrE!', 'premierpet_spc', 'utf8');
    define('URL','/');
//}

//REMOVE CARACTERES ESPECIAIS
function converte($string) {

 		$string = antiInjection($string);
		$string = str_replace("'", "", $string);
		$string = str_replace('"', '', $string);
		$string = str_replace('\\', '', $string);
		$string = str_replace('//', '', $string);
		$string = addslashes($string);

        $map =  array (
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
            'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E',
            'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ð' => 'D', 'Ñ' => 'N',
            'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O',
            'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Ŕ' => 'R',
            'Þ' => 's', 'ß' => 'B', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
            'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
            'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
            'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
            'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y',
            'þ' => 'b', 'ÿ' => 'y', 'ŕ' => 'r'
        );


        $string = strtolower($string);
        $string = strtr($string,$map);

        return strtoupper(trim($string));
}

function antiInjection($str){
	//$str = preg_replace(preg_match("/(\n|\r|%0a|%0d|Content-Type:|bcc:|to:|cc:|Autoreply:|from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "", $str);
	$str = preg_replace("/(\n|\r|%0a|%0d|Content-Type:|bcc:|to:|cc:|Autoreply:|from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/", "", $str);

	$str = trim($str);
	$str = strip_tags($str);
	$str = addslashes($str);
	return $str;
}

function getNomeEmpresa($nome = ''){
    if(strlen($nome) > 0){
        return $nome;
    }
    return 'PremieRpet&reg;';
}