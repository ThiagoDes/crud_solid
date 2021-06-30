<?php

namespace Src\Exception;

use \Exception;

class ValidacaoException extends Exception {

    public function __construct($message = "") {
        parent::__construct($message);
    }

}
