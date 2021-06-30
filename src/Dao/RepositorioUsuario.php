<?php

namespace Src\Dao;

use Src\Dao\ConexaoPdo;
use \PDO;
use \PDOException;
use \ArrayObject;
use Src\Exception\BancoException;
use Src\Model\Usuario;
use Src\Exception\UsuarioException;

class RepositorioUsuario {

    private $conn;
    private $stm;
    private $table = 'users';
    private static $instancia;

    private function __construct() {
        $this->conn = ConexaoPDO::getInstancia()->getDb();
    }

    public static function getInstancia() {
        if (!isSET(self::$instancia))
            self::$instancia = new RepositorioUsuario();
        return self::$instancia;
    }

 private function retornaObjeto($array) {
        return new Usuario(isSET($array["id"]) ? $array["id"] : null, 
        isSET($array["name"]) ? $array["name"] : null,
        isSET($array["login"]) ? $array["login"] : null,
        isSET($array["password"]) ? $array["password"] : null,
        isSET($array["cpf"]) ? $array["cpf"] : null, 
        isSET($array["address"]) ? $array["address"] : null, 
        isSET($array["number"]) ? $array["number"] : null, 
        isSET($array["district"]) ? $array["district"] : null, 
        isSET($array["cep"]) ? $array["cep"] : null, 
        isSET($array["city"]) ? $array["city"] : null, 
        isSET($array["phone"]) ? $array["phone"] : null,
        isSET($array["email"]) ? $array["email"] : null, 
        isSET($array["date_register"]) ? $array["date_register"] : null,
        isSET($array["status"]) ? $array["status"] : null,
        isSET($array["last_access_date"]) ? $array["last_access_date"] : null,
        isSET($array["deleted"]) ? $array["deleted"] : null);
    }

    public function adicionar(Usuario $objUsuario) {
        try {
            $dataExpiracao = date("Y-m-d", strtotime("+45 day", strtotime(date("Y-m-d"))));

            $strSql = "INSERT INTO " . $this->table . " (name, login, password, cpf, address, number, district, cep, city, phone, email, date_register, last_access_date)
                       VALUES(:name, :login, :password, :cpf, :address, :number, :district, :cep, :city, :phone, :email, now(), :expira)";

            $this->stm = $this->conn->prepare($strSql);
            $this->stm->bindValue(":name", $objUsuario->getName()); 
            $this->stm->bindValue(":login", $objUsuario->getLogin());
            $this->stm->bindValue(":password", sha1 ($objUsuario->getPassword() . HASH_ENCRYPT_PASS));
            $this->stm->bindValue(":cpf", $objUsuario->getCpf());
            $this->stm->bindValue(":address", $objUsuario->getAddress());
            $this->stm->bindValue(":number", $objUsuario->getNumber());
            $this->stm->bindValue(":district", $objUsuario->getDistrict());
            $this->stm->bindValue(":cep", $objUsuario->getCep());
            $this->stm->bindValue(":city", $objUsuario->getCity());
            $this->stm->bindValue(":phone", $objUsuario->getPhone());
            $this->stm->bindValue(":email", $objUsuario->getEmail());
            $this->stm->bindValue(":expira", $dataExpiracao);
            $this->stm->execute(); 
            return $this->conn->lastInsertId();
            
        } catch (PDOException $e) {
            throw new BancoException($e);
        }
    }

    public function alterar(Usuario $objUsuario) {
        try {
            $dataExpiracao = date("Y-m-d", strtotime("+45 day", strtotime(date("Y-m-d"))));

            $strComplementoSenha = "";

            if ($objUsuario->getPassword() != "") {
                $strComplementoSenha = ", password = :password, last_access_date = :expiracao";
            }
            $strSql = "UPDATE " . $this->table . "  SET
                        name = :name,
                        login = :login,
                        cpf = :cpf,
                        address = :address,
                        number = :number,
                        district = :district,
                        cep = :cep,
                        city = :city,
                        phone = :phone,
                        email = :email
                        $strComplementoSenha
                        WHERE id = :id";

            $this->stm = $this->conn->prepare($strSql);
            $this->stm->bindValue(":id", $objUsuario->getId());
            $this->stm->bindValue(":name", $objUsuario->getName());
            $this->stm->bindValue(":login", $objUsuario->getLogin());
            $this->stm->bindValue(":cpf", $objUsuario->getCpf());
            $this->stm->bindValue(":address", $objUsuario->getAddress());
            $this->stm->bindValue(":number", $objUsuario->getNumber());
            $this->stm->bindValue(":district", $objUsuario->getDistrict());
            $this->stm->bindValue(":cep", $objUsuario->getCep());
            $this->stm->bindValue(":city", $objUsuario->getCity());
            $this->stm->bindValue(":phone", $objUsuario->getPhone());
            $this->stm->bindValue(":email", $objUsuario->getEmail());
            if ($objUsuario->getPassword() != "") {
                $this->stm->bindValue(":password", sha1 ($objUsuario->getPassword() . HASH_ENCRYPT_PASS));
                $this->stm->bindValue(":expiracao", $dataExpiracao);
            }
            $this->stm->execute();
        } catch (PDOException $e) {
            throw new BancoException($e);
        }
    }

    public function listar($strComplemento = "", $arrBind = array(), Usuario $objUsuario = null) {
        try {

            $retorno = new ArrayObject();
            $strSql = "SELECT * FROM " . $this->table . "  WHERE deleted = 0 $strComplemento";

            $this->stm = $this->conn->prepare($strSql);
            if($objUsuario){
                if($objUsuario->getName() !== null){
                    $this->stm->bindValue(":name", "%".$objUsuario->getName()."%");
                }
                if($objUsuario->getCPF() !== null){
                    $this->stm->bindValue(":cpf", "%".$objUsuario->getCPF()."%");
                }
                if($objUsuario->getStatus() !== null){
                    $this->stm->bindValue(":status", $objUsuario->getStatus());
                }
            
            }

            foreach ($arrBind as $key => $value) {
                $this->stm->bindValue($key, $value);
            }

            $this->stm->execute();
            while ($result = $this->stm->fetch(PDO::FETCH_ASSOC)) {
                $retorno->append($this->retornaObjeto($result));
            }
            
            return $retorno;
        } catch (PDOException $e) {
            throw new BancoException($e);
        }
    }

    public function contar($strComplemento = "", $arrBind = array()) {
        try {

            $strSql = "SELECT COUNT(id) as total FROM " . $this->table . "  WHERE deleted = 0 $strComplemento";
            $this->stm = $this->conn->prepare($strSql);

            foreach ($arrBind as $key => $value) {
                $this->stm->bindValue($key, $value);
            }

            $this->stm->execute();
            $result = $this->stm->fetch(PDO::FETCH_ASSOC);

            return $result["total"];
        } catch (PDOException $e) {
            throw new BancoException($e);
        }
    }

    public function visualizar($intId) {
        $strComplemento = " AND id = :id ";
        $arrParans[":id"] = $intId;

        $retorno = $this->listar($strComplemento, $arrParans);

    if (count($retorno) == 0)
        throw new UsuarioException("Nenhum registro encontrado");

        return $retorno[0];
    }

    public function excluir($intId) {
        try {

            $strSql = "UPDATE " . $this->table . "  SET deleted = 1 WHERE id = :id";
            $this->stm = $this->conn->prepare($strSql);
            $this->stm->bindValue(":id", $intId);
            $this->stm->execute();
        } catch (PDOException $e) {
            throw new BancoException($e);
        }
    }

    public function alterarStatus($intId, $intStatus) {
        try {
            $strSql = "UPDATE " . $this->table . "  SET status = :status WHERE id = :id";
            $this->stm = $this->conn->prepare($strSql);
            $this->stm->bindValue(":status", $intStatus);
            $this->stm->bindValue(":id", $intId);
            $this->stm->execute();
        } catch (PDOException $e) {
            throw new BancoException($e);
        }
    }

    public function logar($strLogin, $strSenha) {
        try {

            $strSql = "SELECT * FROM " . $this->table . " WHERE login = :login AND password = :senha AND deleted = 0 AND status = 1";

            $this->stm = $this->conn->prepare($strSql);
            $this->stm->bindValue(":login", $strLogin);
            $this->stm->bindValue(":senha", $strSenha);
            $this->stm->execute();

            $result = $this->stm->fetch(PDO::FETCH_ASSOC);

            return (!$result) ? false : $this->retornaObjeto($result);
        } catch (PDOException $e) {
            throw new BancoException($e);
        }
    }

    public function buscarPorLogin($strLogin, $intIdUsuario) {

        $strComplemento = "";
        $arrBind = array();

        $strComplemento .= " AND login LIKE :login ";
        $arrBind[":login"] = $strLogin;

        if ($intIdUsuario != null) {
            $strComplemento .= " AND id != :id ";
            $arrBind[":id"] = $intIdUsuario;
        }

        return $this->listar($strComplemento, $arrBind);
    }

    public function buscarPorEmail($strEmail, $intIdUsuario) {
            $strComplemento = " AND email LIKE :email ";
            $arrBind[":email"] = $strEmail;

        if ($intIdUsuario != null) {
            $strComplemento .= " AND id != :id ";
            $arrBind[":id"] = $intIdUsuario;
        }

        return $this->listar($strComplemento, $arrBind);
    }

}
