<?php

namespace Src\Dao;

use Src\Exception\BancoException;
use \PDO;
use \PDOException;

class ConexaoPdo {

    private static $instancia;
    private $db;

    private function __construct() {
        try {
            $host = "localhost";
            $user = "root";
            $pass = "";
            $dbname = "crud-solid";

            $this->db = new PDO("mysql:host=$host; dbname=$dbname;charset=utf8", $user, $pass);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            $this->db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");


        } catch (PDOException $e) {
            throw new BancoException($e);
        }
    }

    public static function getInstancia() {
        if (!isset(self::$instancia)) {
            self::$instancia = new ConexaoPdo();
        }
        return self::$instancia;
    }

    public function getDb() {
        return $this->db;
    }

}
