<?php

namespace Src\Helpers;

use Src\Helpers\Template;
use Src\Helpers\Util;

class ControladorEstatica {

    public static function gerarClasseConstantes() {
        

        $template = new Template(SISTEMA . DIRECTORY_SEPARATOR . "geradoras" . DIRECTORY_SEPARATOR . "permissao" . DIRECTORY_SEPARATOR . "gera.permissao.html");

        $template->QUEBRA_DE_LINHA = "\n";

        //Criando a classe
        $file = fopen(SRC . DIRECTORY_SEPARATOR . "Helpers" . DIRECTORY_SEPARATOR . "Permissao" . DIRECTORY_SEPARATOR . "Constantes.php", "w");

        // Escrevento o arquivo
        fwrite($file, $template->parse());

        //Fechando a conex�o
        fclose($file);
    }

}
