<?php

namespace Src\Controllers;

use Src\Dao\RepositorioUsuario;
use Src\Model\Usuario;
use Src\Exception\UsuarioException;
use Src\Exception\ValidacaoException;
use Src\Helpers\Validacao\Validacao;
use Src\Helpers\Util;

class  ControladorUsuario {

    private static $instancia;

    public static function getInstancia() {
    if (!isset(self::$instancia))
            self::$instancia = new ControladorUsuario();
            return self::$instancia;
    }

    private function getRepositorio() {
            return RepositorioUsuario::getInstancia();
    }

    public static function estaLogado() {
    if (!isset($_SESSION[USUARIO_COCKPIT]))
            return false;
            return true;
    }

    public static function usuarioCockpit() {
            return $_SESSION[USUARIO_COCKPIT];
    }

    public function logar($strLogin, $strSenha) {
            $objValidacao = new Validacao();
            $objValidacao->setRules($strLogin, "required", "Usuário");
            $objValidacao->setRules($strSenha, "required", "Senha");
            $objValidacao->run();


            $pass_md5 = $this->getRepositorio()->logar($strLogin, md5($strSenha));

        if(!$pass_md5) {
            throw new UsuarioException("Login/Senha inválido!");   
        }

        $_SESSION[USUARIO_COCKPIT] = $pass_md5; 
    }

    public function adicionar($strName, $strLogin, $strPassword, $strCpf, $strAddress, $strNumber, $strDistrict, $strCep, $strCity, $strPhone, $strEmail) {
        $strCpf = Util::formatar("numerico", $strCpf);
        $strCep = Util::formatar("numerico", $strCep);

        $objValidacao = new Validacao();
        $objValidacao->setRules($strName, "trim|required|maxlength[100]", "Nome");
        $objValidacao->setRules($strLogin, "trim|required|maxlength[50]", "Login");
        $objValidacao->setRules($strPassword, "required|maxlength[10]", "Senha");
        $objValidacao->setRules($strCpf, "trim|required", "CPF");
        $objValidacao->setRules($strAddress, "trim|blank|maxlength[50]", "Logradouro");
        $objValidacao->setRules($strNumber, "trim|required|maxlength[50]", "Numéro");
        $objValidacao->setRules($strDistrict, "trim|required|maxlength[50]", "Bairro");
        $objValidacao->setRules($strCep, "trim|required", "CEP");
        $objValidacao->setRules($strCity, "trim|required|maxlength[50]", "Cidade");
        $objValidacao->setRules($strPhone, "trim|required", "Telefone");             
        $objValidacao->setRules($strEmail, "trim|required|maxlength[50]", "E-mail");
        $objValidacao->run();

        if (!Util::validarSenha($strPassword)) {
                throw new ValidacaoException("Sua senha não foi aprovada! Favor crie uma senha contendo no mínimo 8 dígitos sendo, 3 letras, 3 números, e 2 caracteres especiais.");
        }

        if (count($this->buscarPorLogin($strLogin)) > 0) {
                throw new ValidacaoException("Login já cadastrado");
        }

        if (count($this->buscarPorEmail($strEmail)) > 0) {
                throw new ValidacaoException("E-mail já cadastrado");
        }

        $objUsuario = new Usuario(null, $strName, $strLogin, $strPassword, $strCpf, $strAddress, $strNumber, $strDistrict, $strCep, $strCity, $strPhone, $strEmail);

        $this->getRepositorio()->adicionar($objUsuario);
        
    }

    public function alterar($intId, $strName, $strLogin, $strPassword, $strCpf, $strAddress, $strNumber, $strDistrict, $strCep, $strCity, $strPhone, $strEmail) {
        $strCpf = Util::formatar("numerico", $strCpf);
        $strCep = Util::formatar("numerico", $strCep);

        $objValidacao = new Validacao();
        $objValidacao->setRules($strName, "trim|required|maxlength[100]", "Nome");
        $objValidacao->setRules($strLogin, "trim|required|maxlength[50]", "Login");
        $objValidacao->setRules($strPassword, "blank|maxlength[10]", "Senha");
        $objValidacao->setRules($strCpf, "trim|required", "CPF");
        $objValidacao->setRules($strAddress, "trim|blank|maxlength[50]", "Logradouro");
        $objValidacao->setRules($strNumber, "trim|required|maxlength[50]", "Numéro");
        $objValidacao->setRules($strDistrict, "trim|required|maxlength[50]", "Bairro");
        $objValidacao->setRules($strCep, "trim|required", "CEP");
        $objValidacao->setRules($strCity, "trim|required|maxlength[50]", "Cidade");
        $objValidacao->setRules($strPhone, "trim|required", "Telefone");             
        $objValidacao->setRules($strEmail, "trim|required|maxlength[50]", "E-mail");
        $objValidacao->run();

        if (!Util::validarSenha($strPassword) && isset($strSenha)) {
            throw new ValidacaoException("Sua senha não foi aprovada! Favor crie uma senha contendo no mínimo 8 dígitos sendo, 3 letras, 3 números, e 2 caracteres especiais.");
        }

        if (count($this->buscarPorLogin($strLogin, $intId)) > 0) {
            throw new ValidacaoException("Login já cadastrado");
        }

        if (count($this->buscarPorEmail($strEmail, $intId)) > 0) {
            throw new ValidacaoException("E-mail já cadastrado");
        }

        $objUsuario = new Usuario($intId, $strName, $strLogin, $strPassword, $strCpf, $strAddress, $strNumber, $strDistrict, $strCep, $strCity, $strPhone, $strEmail);

        $this->getRepositorio()->alterar($objUsuario);

        if(self::usuarioCockpit()->getId() == $intId){                
            $_SESSION[USUARIO_COCKPIT] = $this->visualizar($intId);
        }
    }

    public function listarTodos($intPage = null, $arrPost = array()){
        $strComplemento = "";
        $objUsuario = new Usuario();

        if(count($arrPost) > 0){
            if(isset($arrPost['strName']) && !empty($arrPost['strName'])){
                $objUsuario->setName($arrPost['strName']);
                $strComplemento .= " AND name LIKE :name";
            }
            if(isset($arrPost['strCPF']) && !empty($arrPost['strCPF'])){
                $objUsuario->setCPF($arrPost['strCPF']);
                $strComplemento .= " AND cpf LIKE :cpf";
            }    
            if(isset($arrPost['intStatus']) && !empty($arrPost['intStatus'])){
                if($arrPost['intStatus'] == 2) {$arrPost['intStatus'] = 0;}
                $objUsuario->setStatus($arrPost['intStatus']);
                $strComplemento .= " AND status = :status";
            }
        }

        $strComplemento .= " ORDER BY id ASC";

        if(count($arrPost) > 0){  
            $strComplemento .= " LIMIT 25";
        }else{
            $strComplemento .= " LIMIT ".REGISTROS_POR_PAGINA;
        }

        if($intPage != null && count($arrPost) < 1){
            $objValidacao = new Validacao();
            $objValidacao->setRules($intPage, "numeric", "Página");
            $objValidacao->run();

            $intPage *= REGISTROS_POR_PAGINA;
            $strComplemento .= " OFFSET ".$intPage;
        }

        return $this->getRepositorio()->listar($strComplemento, array(), $objUsuario);
    }

    public function contar(){
        return $this->getRepositorio()->contar();
    }

    public function excluir($intId) {
        $objValidacao = new Validacao();
        $objValidacao->setRules($intId, "required|numeric", "Indentificador Inválido para exclusão");
        $objValidacao->run();

        $this->getRepositorio()->excluir($intId);

    }

    public function visualizar($intId) {
        $objValidacao = new Validacao();
        $objValidacao->setRules($intId, "required|numeric", "ID");
        $objValidacao->run();

        return $this->getRepositorio()->visualizar($intId);
    }

    public function alterarStatus($intId, $intStatus) {
        $objValidacao = new Validacao();
        $objValidacao->setRules($intStatus, "required|numeric", "STATUS");
        $objValidacao->setRules($intId, "required|numeric", "Indentificador Inválido para exclusão");
        $objValidacao->run();

        if ($intStatus != 0 && $intStatus != 1) {
            throw new ValidacaoException("Campo \"STATUS\" deve ser 0 ou 1");
        }

        $this->getRepositorio()->alterarStatus($intId, $intStatus);
    
    }

    public function buscarPorLogin($strLogin, $intIdUsuario = null) {
        return $this->getRepositorio()->buscarPorLogin($strLogin, $intIdUsuario);
    }

    public function buscarPorEmail($strEmail, $intIdUsuario = null) {
        return $this->getRepositorio()->buscarPorEmail($strEmail, $intIdUsuario);
    }



}
