<?php

header('Access-Control-Allow-Origin: *');

/*  Definindo o content da página */
header('Content-Type: text/html; charset=UTF-8');

/* Definindo o locale  */
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

/* Definindo Time Zone */
date_default_timezone_set("Brazil/East");

/* base dir */
define('BASE', dirname(__FILE__));

/* base url */
$phpself = (dirname($_SERVER['PHP_SELF']) == "/" || dirname($_SERVER['PHP_SELF']) == "\\") ? "" : dirname($_SERVER['PHP_SELF']);
define('BASE_URL', "http://" . $_SERVER['HTTP_HOST'] . $phpself);

/* Novos defines */
define('USUARIO_COCKPIT', "uhasd987210u1123asdsad2198ey219hd981hd29sala");
define('PERMISSAO_USUARIO_COCKPIT', "173hd9812123asdsd1hd129d12dg128ddsala");
define('REGISTROS_POR_PAGINA', 25);

/* definição de constantes da arquitetura */
define("SRC", BASE . DIRECTORY_SEPARATOR . "src");
define("SISTEMA", BASE . DIRECTORY_SEPARATOR . "view");
define("ARQUIVOS", BASE . DIRECTORY_SEPARATOR . "arquivos");
define("INCLUDES", SISTEMA . DIRECTORY_SEPARATOR . "includes");

define('TITULO_PROJETO', 'Crud SOLID');
define('INFO_RODAPE', 'ThiagoDev. Todos os Direitos Reservados.');

/* definição do Ambiente */
define('AMBIENTE_DESENVOLVIMENTO', 1);
define('AMBIENTE_PRODUCAO', 2);
define('AMBIENTE', AMBIENTE_DESENVOLVIMENTO);

define('SIS_OFF', 1);
define('SIS_ON', 2);
define('SIS', SIS_ON);

define('HASH_ENCRYPT_PASS', '7080cddb1f1b366f012d9fc76aa0b371');

// debug ativo
if (AMBIENTE == AMBIENTE_DESENVOLVIMENTO) {
    error_reporting(E_STRICT);
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

// carregando o autoload do composer
require_once 'vendor/autoload.php';

/* Inicializa a sessão e remove o cache */
session_start();

use Src\Exception\PaginaNaoEncontrada;
use Src\Helpers\Config;

try {
    $page = Config::getPageByRewrite($parametro);

	if(SIS == 1 && $page != "view/manutencao/index.php"){
	    include("view/manutencao/index.php");
		die;
	}

    include($page);
} catch (PaginaNaoEncontrada $e) {
    header("Location: " . BASE_URL . '/404');
} catch (Exception $e){
    header("Location: " . BASE_URL);
}
