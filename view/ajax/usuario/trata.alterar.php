<?php

use Src\Controllers\ControladorUsuario;
use Src\Exception\ValidacaoException;
use Src\Exception\BancoException;
use Src\Exception\UsuarioException;

try {

    $senha = ($_POST["strPassword"] != '') ? $_POST["strPassword"] : null;
    ControladorUsuario::getInstancia()->alterar($_POST["intId"], $_POST["strName"], $_POST["strLogin"], $senha, $_POST["strCpf"], $_POST["strAddress"], $_POST["strNumber"], $_POST["strDistrict"], $_POST["strCep"], $_POST["strCity"], $_POST["strPhone"], $_POST["strEmail"]);

    $retorno["status"] = "ok";
    $retorno["msg"] = "Registro alterado com sucesso!";
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
// var_dump($retorno);