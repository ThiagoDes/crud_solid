<?php

namespace Src\Exception;

use \Exception;

class BancoException extends Exception
{

    public function __construct($pdoException)
    {

        if (AMBIENTE == AMBIENTE_DESENVOLVIMENTO) {
            var_dump($pdoException);
        } else {
            $msg = "Problema na conexão com banco de dados.";
        }

        parent::__construct($msg);
    }

}
