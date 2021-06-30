<?php

use Src\Controllers\ControladorUsuario;
use Src\Exception\ValidacaoException;
use Src\Exception\UsuarioException;
use Src\Exception\BancoException;

try {
    ControladorUsuario::getInstancia()->logar($_POST["strLogin"], $_POST["strSenha"]);

    $resposta["status"] = "ok";
    $resposta["msg"] = "Login efetuado com sucesso!";
} catch (ValidacaoException $e) {
    $resposta["status"] = "erro";
    $resposta["msg"] = $e->getMessage();
} catch (UsuarioException $e) {
    $resposta["status"] = "erro";
    $resposta["msg"] = $e->getMessage();
} catch (BancoException $e) {
    $resposta["status"] = "erro";
    $resposta["msg"] = $e->getMessage();
}

echo json_encode($resposta);
// var_dump($resposta);
