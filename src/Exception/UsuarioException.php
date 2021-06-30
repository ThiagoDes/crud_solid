<?php

namespace Src\Exception;

use \Exception;

class UsuarioException extends Exception {

    public function __construct($msg = "") {
        parent::__construct($msg);
    }

}
