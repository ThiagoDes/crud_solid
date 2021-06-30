<?php

namespace Src\Helpers;

use Src\Exception\PaginaNaoEncontrada;

class Config {

    public static function redirecionar($page) {
        header("Location: " . BASE_URL . "/" . $page);
        exit;
    }

    public static function getPageByRewrite(&$parametro = array()) {

        // verificando se existe algo na url
        if (isset($_GET['url']) && $_GET['url'] != '') {
            $arrayUrl = explode("/", $_GET['url']);
            $qtdUrl = count($arrayUrl);
        } else {
            $qtdUrl = 0;
        }

        switch ($qtdUrl) {
            // modulo 
            case 1:
                $pagina = $arrayUrl[0] . '/index.php';
                break;

            // modulo/pagina 
            case 2:
                if(is_numeric($arrayUrl['1'])){
                    $pagina = $arrayUrl[0] . '/index.php';
                    $parametro = $arrayUrl[1];
                }else{
                    if(empty($arrayUrl['1'])){
                        $pagina = $arrayUrl[0] . '/index.php';
                    }else{
                        $pagina = $arrayUrl[0] . '/' . $arrayUrl['1'] . '.php';
                    }
                }
                break;

            // modulo/pagina/IDitem
            case 3:
                if ((int) $arrayUrl[2] != 0) {
                    $pagina = $arrayUrl[0] . '/' . $arrayUrl['1'] . '.php';
                    $parametro = $arrayUrl[2];
                } else {
                    $pagina = $arrayUrl[0] . '/' . $arrayUrl['1'] . '/' . $arrayUrl['2'];
                }
                break;

            // padrao para não gerar erro
            default:
                $pagina = 'index.php';
                break;
        }

        if (file_exists(BASE . "/view/" . $pagina)) {
            return "view/" . $pagina;
        } else {
            throw new PaginaNaoEncontrada("Página não encontrada");
        }
    }

}
