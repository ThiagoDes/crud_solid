<?php

use Src\Controllers\ControladorUsuario;
use Src\Exception\ValidacaoException;
use Src\Exception\BancoException;
use Src\Exception\UsuarioException;

try {
    ControladorUsuario::getInstancia()->excluir($_POST["intId"]);

    $retorno["status"] = "ok";
    $retorno["msg"] = "Registro excluído com sucesso";
} catch (ValidacaoException $e) {
    $retorno["status"] = "erro";
    $retorno["msg"] = $e->getMessage();
} catch (UsuarioException $e) {
    $retorno["status"] = "erro";
    $retorno["msg"] = $e->getMessage();
} catch (BancoException $e) {
    $retorno["status"] = "erro";
    $retorno["msg"] = $e->getMessage();
}

echo json_encode($retorno);
