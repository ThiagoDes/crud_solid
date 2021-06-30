<?php

namespace Src\Exception;

use \Exception;

class PaginaNaoEncontrada extends Exception {

    function __construct($message) {
        parent::__construct($message);
    }

}
