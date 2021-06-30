<?php

namespace Src\Helpers\Validacao;

use Src\Exception\ValidacaoException;

class Validacao {

    private $values = array();
    private $rules = array();
    private $fields = array();
    private $key = null;
    private $error;
    private $exteption = false;

    public function __construct() {
        $this->error = array();
    }

    public function setRules(&$value, $rules, $field) {
        $this->maketrim($value, $rules);
        $this->addValue($value);
        $this->addRules($rules);
        $this->addField($field);
    }

    private function addValue($value) {
        $this->value[] = $value;
    }

    private function addRules($rules) {
        $this->rules[] = $rules;
    }

    private function addField($field) {
        $this->fields[] = $field;
    }

    private function maketrim(&$value, &$rules) {

        $regras = explode("|", $rules);
        $array = array();
        foreach ($regras as $regra) {
            if ($regra == "trim")
                $value = trim($value);
            else
                $array[] = $regra;
        }
        $rules = implode("|", $array);
    }

    public function close() {
        unset($_SESSION["_validacao_erros_"]);
        unset($_SESSION["_validacao_last_value_"]);
    }

    public function run() {
        foreach ($this->value as $this->key => $value) {
            $value = addslashes($value);

            $rules = explode("|", $this->rules[$this->key]);
            foreach ($rules as $rule) {
                $parameter = "";
                if (!strpos($rule, "[") === false && !strpos($rule, "]") === false) {
                    $array = explode("[", $rule);
                    $rule = $array[0];
                    $parameter = str_replace("]", "", $array[1]);
                }

                eval("\$this->_" . $rule . "(\"$value\",\"$parameter\");");
            }
        }
    }

    public function get($field) {
        if (isset($_SESSION["_validacao_last_value_"][$field]))
            return $_SESSION["_validacao_last_value_"][$field];
        else
            return"";
    }

    public function getError($field) {
        if (!isset($_SESSION["_validacao_erros_"]))
            if (!isset($this->error[$field]))
                return "";
            else
                return $this->error[$field];
        else
        if (!isset($_SESSION["_validacao_erros_"][$field]))
            return "";
        else
            return $_SESSION["_validacao_erros_"][$field];
    }

    private function setError($strError) {
        throw new ValidacaoException("Campo \"{$this->fields[$this->key]}\" $strError");
    }

    public function getAllErrors() {
        if (!isset($_SESSION["_validacao_erros_"])) {
            if (!isset($this->error))
                return "";
            else
                $array = $this->error;
        }else {
            $array = $_SESSION["_validacao_erros_"];
        }

        foreach ($array as $key => $msg) {
            echo $key . " - " . $msg . "<br>";
        }
    }

    private function _required($value) {
        if ($value == "")
            $this->setError("é obrigatório");
    }

    private function _blank($value){

    }

    private function _valid_email($strEmail) {
        /* Caso o campo não seja obrigatório, ele não precisa ser validado */
        if (empty($strEmail))
            return;
        $strEmail = strtolower(trim($strEmail));
        if (preg_match('/^([_\.0-9a-z-]+)@(([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})$/', $strEmail, $arrEmail)) {
            $strHost = $arrEmail[2];
            $strIP = gethostbyname($strHost);
        } else {
            $this->setError("inválido");
        }
    }

    private function _maxlength($value, $tam) {
        if (empty($value))
            return;
        if (strlen($value) > $tam)
            $this->setError("ultrapassou o tamanho máximo permitido [$tam]");
    }

    private function _minlength($value, $tam) {
        if (empty($value))
            return;
        if (strlen($value) < $tam)
            $this->setError("não atingiu o tamanho mínimo permitido [$tam]");
    }

    private function _maxvalue($value, $max){
        if (empty($value))
            return;
        if ($value > $max)
            $this->setError("ultrapassou o valor máximo permitido [$max]");
    }

    private function _minvalue($value, $min){
        if (empty($value))
            return;
        if ($value < $min)
            $this->setError("não atingiu o valor mínimo permitido [$min]");
    }

    private function _numeric($value) {
        if (empty($value))
            return;
        if (!is_numeric($value))
            $this->setError("deve ser numérico");
    }

    private function _cep($value) {
        if (empty($value))
            return;
        if (!(isset($value) && preg_match("/^[0-9]{5}-[0-9]{3}$/", $value)))
            $this->setError("inválido");
    }

    private function _confirm($value, $valueToConfirm) {
        if ($value != $valueToConfirm)
            $this->setError("confirmação inválida");
    }

    private function _date($value, $mode) {
        if ($mode == "ptbr") {
            if (!preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $value))
                $this->setError("formato inválido");
        }else if ($mode == "usa") {
            if (!preg_match('/^\d{1,4}-\d{1,2}-\d{2}$/', $value))
                $this->setError("formato inválido");
        }
    }

    private function _cpf($value) {
        if (empty($value))
            return;
        if (!(isset($value) && preg_match("/^([0-9]{3}\.){2}[0-9]{3}-[0-9]{2}$/", $value))) {
            $this->setError("inválido");
            echo "erro 1";
        } else {
            $value = str_pad(preg_replace('/[^0-9]/', '', $value), 11, '0', STR_PAD_LEFT);
            if (strlen($value) != 11 || $value == '00000000000' || $value == '11111111111' || $value == '22222222222' || $value == '33333333333' || $value == '44444444444' || $value == '55555555555' || $value == '66666666666' || $value == '77777777777' || $value == '88888888888' || $value == '99999999999') {
                $this->setError("inválido");
                echo "erro 2";
                for ($t = 9; $t < 11; $t++) {
                    for ($d = 0, $c = 0; $c < $t; $c++) {
                        $d += $value{$c} * (($t + 1) - $c);
                    }
                    $d = ((10 * $d) % 11) % 10;
                    if ($value{$c} != $d) {
                        $this->setError("inválido");
                        echo "erro 3";
                    }
                }
            }
        }
    }

}
