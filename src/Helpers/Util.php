<?php

namespace Src\Helpers;

use Src\Helpers\Permissao\Permissao;

class Util {

    const PERMISSAO_PADRAO = 0775;

    public static function inverteData($strData) {
        $strData = trim($strData);
        $arrayData = explode(" ", $strData);

        $data = $arrayData[0];
        $hora = (isset($arrayData[1])) ? " " . substr($arrayData[1], 0, 5) : "";

        if (strpos($data, "/")) {
            list($dia, $mes, $ano) = explode("/", $data);
            return $ano . "-" . $mes . "-" . $dia . $hora;
        } else if (strpos($data, "-")) {
            list($ano, $mes, $dia) = explode("-", $data);
            return $dia . "/" . $mes . "/" . $ano . $hora;
        }
    }

    public static function inverteDataSemHora($strData) {
        $strData = trim($strData);
        $arrayData = explode(" ", $strData);

        $data = $arrayData[0];

        if (strpos($data, "/")) {
            list($dia, $mes, $ano) = explode("/", $data);
            return $ano . "-" . $mes . "-" . $dia;
        } else if (strpos($data, "-")) {
            list($ano, $mes, $dia) = explode("-", $data);
            return $dia . "/" . $mes . "/" . $ano;
        }
    }

    public static function compararData($strDataInicial, $strDataFinal, $strMensagem = "A data final não pode ser menor que a inicial.") {

        /* ptbr to usa */
        if (strpos($strDataInicial, "/")) {
            $strDataInicial = self::inverteData($strDataInicial);
        }

        /* ptbr to usa */
        if (strpos($strDataFinal, "/")) {
            $strDataFinal = self::inverteData($strDataFinal);
        }


        if ($strDataFinal < $strDataInicial) {
            throw new ValidacaoException($strMensagem);
        }
    }

    public static function array_obj_diff($array1, $array2) {

        foreach ($array1 as $key => $value) {
            $array1[$key] = serialize($value);
        }

        foreach ($array2 as $key => $value) {
            $array2[$key] = serialize($value);
        }

        $array_diff = array_diff($array1, $array2);

        foreach ($array_diff as $key => $value) {
            $array_diff[$key] = unserialize($value);
        }

        return $array_diff;
    }

    public static function cortarTexto($str, $intLimit) {

        if (strlen($str) <= $intLimit) {
            return $str;
        } else {
            $str = substr($str, 0, $intLimit);
        }
        return $str . "...";
    }

    public static function geraBoxAprovar($intId, $intAprovado) {


            $selectedAprovado = ($intAprovado == 1) ? "selected=\"selected\"" : "";
            $selectedNaoAprovado = ($intAprovado == 0) ? "selected=\"selected\"" : "";

            $objTemplate = new Template(SISTEMA . DIRECTORY_SEPARATOR . "geradoras" . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "gera.select.html");
            $objTemplate->ID_SELECT = $intId;
            $objTemplate->CLASSE_SELECT = "select_aprovar";

            $objTemplate->VALOR = 1;
            $objTemplate->SELECTED = $selectedAprovado;
            $objTemplate->DESCRICAO = "Aprovado";
            $objTemplate->block("BLOCK_OPTION");

            $objTemplate->VALOR = 0;
            $objTemplate->SELECTED = $selectedNaoAprovado;
            $objTemplate->DESCRICAO = "Não Aprovado";
            $objTemplate->block("BLOCK_OPTION");

            $objTemplate->block("BLOCK_SELECT");

            $objTemplate->show();
    }

    public static function geraBoxStatus($intId, $intStatus) {

        $selectedAtivo = ($intStatus == 1) ? "selected=\"selected\"" : "";
        $selectedInativo = ($intStatus == 0) ? "selected=\"selected\"" : "";

        $objTemplate = new Template(SISTEMA . DIRECTORY_SEPARATOR . "geradoras" . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "gera.select.html");
        $objTemplate->ID_SELECT = $intId;
        $objTemplate->CLASSE_SELECT = "select_status";

        $objTemplate->VALOR = 1;
        $objTemplate->SELECTED = $selectedAtivo;
        $objTemplate->DESCRICAO = "Ativo";
        $objTemplate->block("BLOCK_OPTION");

        $objTemplate->VALOR = 0;
        $objTemplate->SELECTED = $selectedInativo;
        $objTemplate->DESCRICAO = "Inativo";
        $objTemplate->block("BLOCK_OPTION");

        $objTemplate->block("BLOCK_SELECT");

        $objTemplate->show();
        
    }

    public static function gerarPaginacao($intPaginas, $intPage, $intQtd, $strPagina){
        $strLink = "#";
        $strClass = "";
        $intPageCod = $intPage - 1;

        if($intPage == $intPaginas){
            $intResto = ($intPageCod*25)+($intQtd%25);
        }else{
            $intResto = ($intPageCod*25)+25;
        }

        $strPaginacao = "
        <div class=\"row\">
        <div class=\"col-xs-12 col-sm-12 col-md-5\">
        <div class=\"dataTables_info\" id=\"tabelaData_info\" role=\"status\" aria-live=\"polite\">Mostrando ".(($intPageCod*25)+1)." a ".$intResto." de ".$intQtd." registros</div>
        </div>
        <div class=\"col-xs-12 col-sm-12 col-md-7\">
        <div class=\"dataTables_paginate paging_full_numbers\" id=\"tabelaData_paginate\">
        <ul class=\"pagination\">";

        if($intPage <= 1){
            $strLink = "#";
            $strClass = "disabled";
        }else{
            $strLink = "1";
            $strClass = "";
        }
        $strPaginacao .= "<li class=\"paginate_button page-item ".$strClass."\"><a href=\"".BASE_URL."/".$strPagina."/".$strLink."\" class=\"page-link\">Primeiro</a></li>";
        

        if($intPage >= 2){
            $strLink = $intPage-1;
            $strClass = "";
        }else{
            $strLink = "#";
            $strClass = "disabled";
        }
        $strPaginacao .= "<li class=\"paginate_button page-item ".$strClass."\"><a href=\"".BASE_URL."/".$strPagina."/".$strLink."\" class=\"page-link\">Anterior</a></li>";

        if($intPage < $intPaginas){
            $strLink = $intPage+1;
            $strClass = "";
        }else{
            $strLink = "#";
            $strClass = "disabled";
        }
        $strPaginacao .= "<li class=\"paginate_button page-item ".$strClass."\"><a href=\"".BASE_URL."/".$strPagina."/".$strLink."\" class=\"page-link\">Próximo</a></li>";

        if($intPage >= $intPaginas){
            $strLink = "#";
            $strClass = "disabled";
        }else{
            $strLink = $intPaginas;
            $strClass = "";
        }
        $strPaginacao .= "<li class=\"paginate_button page-item ".$strClass."\"><a href=\"".BASE_URL."/".$strPagina."/".$strLink."\" class=\"page-link\">Último</a></li>";

        $strPaginacao .= "
        </ul>
        </div>
        </div>
        </div>";


        echo $strPaginacao;
        
    }

    public static function geraBoxAcoes($intId) {

        echo '<button class="btn btn-warning btn-sm bt_alterar" style="margin-left: 10px;" id="' . $intId . '" title="Alterar"><i class="icofont icofont-pencil-alt-2"></i> Alterar</button>'; 
        echo '<button class="btn btn-danger btn-sm bt_excluir" style="margin-left: 10px;" id="' . $intId . '" title="Excluir"><i class="icofont icofont-trash"></i> Excluir</button>';
    }

    public static function retiraAcento($str) {
        $arrAcentos = array("Á", "É", "Í", "Ó", "Ú", "Â", "Ê", "Î", "Ô", "Û", "Ã", "Ñ", "Õ", "Ä", "Ë", "Ï", "Ö", "Ü", "À", "È", "Ì", "Ò", "Ù", "á", "é", "í", "ó", "ú", "â", "ê", "î", "ô", "û", "ã", "ñ", "õ", "ä", "ë", "ï", "ö", "ü", "à", "è", "ì", "ò", "ù", ".", ",", ":", ";", "...", "ç", "%", "?", "/", "\\", "”", "“", "'", "!", "@", "#", "$", "*", "(", ")", "+", "=", "{", "}", "[", "]", "|", "<", ">", "\"", "&ordf;", "&ordm;", "&deg;", "‘", "‘", "&raquo;", "ª", "º", "»", "´", "~", "&", "°", "²", "³");
        $arrSemacento = array("a", "e", "i", "o", "u", "a", "e", "i", "o", "u", "a", "n", "o", "a", "e", "i", "o", "u", "a", "e", "i", "o", "u", "a", "e", "i", "o", "u", "a", "e", "i", "o", "u", "a", "n", "o", "a", "e", "i", "o", "u", "a", "e", "i", "o", "u", "", "", "", "", "", "c", "_porcento", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "e", "", "2", "3");

        for ($intPos = 0; $intPos < count($arrAcentos); $intPos++) {
            $str = str_replace($arrAcentos[$intPos], $arrSemacento[$intPos], $str);
        }

        return strtolower($str);
    }

    public static function formatarTituloParaUrl($strTitulo) {
        $strTitulo = self::retiraAcento($strTitulo);
        $strTitulo = str_replace(" ", "-", $strTitulo);
        return $strTitulo;
    }

    public static function arrayMapRecursivo($callback, $array) {
        $arrMapeado = array();
        foreach ($array as $key => $posicao) {
            if (is_array($posicao)) {
                $arrMapeado[$key] = Util::arrayMapRecursivo($callback, $posicao);
            } else {
                $arrMapeado[$key] = $callback($posicao);
            }
        }
        return $arrMapeado;
    }

    public static function getIp() {
        return $_SERVER["REMOTE_ADDR"];
    }

    public static function gerarSenha($intTam = 6) {
        $array = array(
            array("1", "2", "3", "4", "5", "6", "7", "8", "9"),
            array("a", "b", "c", "d", "e", "f", "g", "h", "k", "m", "n", "p", "q", "r", "s", "t", "u", "v", "x", "z")
        );
        $strSenha = "";
        for ($i = 0; $i < $intTam; $i++) {
            $key = rand(0, count($array) - 1);
            $strSenha .= $array[$key][rand(0, count($array[$key]) - 1)];
        }
        return $strSenha;
    }

    public static function getExtensao($strFileName) {
        $pecas = explode(".", $strFileName);
        $tam = count($pecas);
        return $pecas[$tam - 1];
    }

    public static function criarArquivo($strArquivo) {
        self::criarDiretorio(dirname($strArquivo));

        $file = fopen($strArquivo, "w+");
        fclose($file);

        chmod($strArquivo, self::PERMISSAO_PADRAO);
    }

    public static function criarDiretorio($strDir) {

        $partes = explode(DIRECTORY_SEPARATOR, str_replace(BASE, "", $strDir));
        $parte_anterior = "";
        foreach ($partes as $parte) {
            if (!is_dir(BASE . DIRECTORY_SEPARATOR . $parte_anterior . $parte)) {
                mkdir(BASE . DIRECTORY_SEPARATOR . $parte_anterior . $parte, self::PERMISSAO_PADRAO, true);
            }
            $parte_anterior .= $parte . DIRECTORY_SEPARATOR;
        }
    }

    public static function getHoraData($strData) {
        $hora = explode(" ", $strData);
        return substr($hora[1], 0, 2);
    }

    public static function getMinutoData($strData) {
        $minuto = explode(" ", $strData);
        return substr($minuto[1], 3, 2);
    }

    public function getSubDataHora($strHoraDataInicial, $strHoraDataFinal) {
        $data_login = strtotime($strHoraDataInicial);
        $data_logout = strtotime($strHoraDataFinal);

        $tempo_con = mktime(date('H', $data_logout) - date('H', $data_login), date('i', $data_logout) - date('i', $data_login), date('s', $data_logout) - date('s', $data_login));

        return date('H:i', $tempo_con);
    }

    public static function getDataCompleta($strData) {
        $strData = ($strData == "") ? "00-00-0000 00:00:00" : $strData;
        $arrDataHora = explode(" ", $strData);
        $arrData = explode("-", $arrDataHora[0]);
        $intDia = $arrData[2];
        $intMes = $arrData[1];
        $intAno = $arrData[0];
        $intHora = "00";
        $intMinuto = "00";
        $intSegundo = "00";
        if (array_key_exists(1, $arrDataHora)) {

            $arrHora = explode(":", $arrDataHora[1]);
            $intHora = $arrHora[0];
            $intMinuto = $arrHora[1];
            $intSegundo = $arrHora[2];
        }
        $array['dia'] = $intDia;
        $array['mes'] = $intMes;
        $array['ano'] = $intAno;
        $array['hora'] = $intHora;
        $array['minuto'] = $intMinuto;
        $array['segundo'] = $intSegundo;
        return $array;
    }

    function formata_data_extenso($strDate) {
        // Array com os dia da semana em português;
        $arrDaysOfWeek = array('Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado');
        // Array com os meses do ano em português;
        $arrMonthsOfYear = array(1 => 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
        // Descobre o dia da semana
        $intDayOfWeek = date('w', strtotime($strDate));
        // Descobre o dia do mês
        $intDayOfMonth = date('d', strtotime($strDate));
        // Descobre o mês
        $intMonthOfYear = date('m', strtotime($strDate));
        // Descobre o ano
        $intYear = date('Y', strtotime($strDate));
        // Formato a ser retornado
        return $arrDaysOfWeek[$intDayOfWeek] . ', ' . $intDayOfMonth . ' / ' . $intMonthOfYear . ' / ' . $intYear;
    }

    function limitarTexto($string, $num) {
        $total = strlen($string);
        $texto = substr($string, 0, $num);
        $separar = explode(" ", $texto);
        $end = "";

        if ($total >= $num) {
            for ($i = 0; $i < (count($separar) - 1); $i++) {
                $end .= $separar[$i] . " ";
            }

            $end .= '...';
        } else {
            $end = $texto;
        }
        return $end;
    }

    public static function validaData($strData) {
        $valido = true;

        $strData = trim($strData);
        list($dia, $mes, $ano) = explode("/", $strData);

        if ($mes > 12 || $mes == 0) {
            $valido = false;
        } else {
            if ($mes == 1 || $mes == 3 || $mes == 5 || $mes == 7 || $mes == 8 || $mes == 10 || $mes == 12) {
                if ($dia == 0 || $dia > 31)
                    $valido = false;
            }elseif ($mes == 2) {
                if ($dia == 0 || $dia > 29) {
                    $valido = false;
                } else {
                    if ($ano % 4 == 0 && $dia > 29) {
                        $valido = false;
                    } elseif ($ano % 4 != 0 && $dia > 28) {
                        $valido = false;
                    }
                }
            } elseif ($mes == 4 || $mes == 6 || $mes == 9 || $mes == 11) {
                if ($dia == 0 || $dia > 30)
                    $valido = false;
            }
        }
        if (strlen($ano) < 4 || (substr($ano, 0, 2) != "20" && substr($ano, 0, 2) != "19")) {
            $valido = false;
        }
        return $valido;
    }

    public static function validarSenha($senha) {
        return (preg_match("/.*?([a-z]).*?([a-z]).*?([a-z]).*?/i", $senha) && preg_match("/.*?([0-9]).*?([0-9]).*?([0-9]).*?/i", $senha) && preg_match("/.*?([\!\@\#\$\%\&\*\+\_\-\?]).*?/i", $senha)) ? true : false;
    }

    public static function formatar($tipo = "", $string, $size = 10){
        $string = preg_replace("[^0-9]", "", $string);
        
        switch ($tipo){
            case 'fone':
            if($size === 10){
                $string = '(' . substr($string, 0, 2) . ') ' . substr($string, 2, 4) . '-' . substr($string, 6);
            }elseif($size === 11){
                $string = '(' . substr($string, 0, 2) . ') ' . substr($tstring, 2, 5) . '-' . substr($string, 7);
            }
            break;
            case 'cep':
            $string = substr($string, 0, 5) . '-' . substr($string, 5, 3);
            break;
            case 'cpf':
            $string = substr($string, 0, 3) . '.' . substr($string, 3, 3) . '.' . substr($string, 6, 3) . '-' . substr($string, 9, 2);
            break;
            case 'cnpj':
            $string = substr($string, 0, 2) . '.' . substr($string, 2, 3) . '.' . substr($string, 5, 3) . '/' . substr($string, 8, 4) . '-' . substr($string, 12, 2);
            break;
            case 'rg':
            $string = substr($string, 0, 2) . '.' . substr($string, 2, 3) . '.' . substr($string, 5, 3);
            break;
            case 'numerico':
            $string = preg_replace('/[^\d]/', '',$string);
            break;
            default:
            $string = 'É ncessário definir um tipo(fone, cep, cpg, cnpj, rg)';
            break;
        }
        return $string;
    }

    public static function converterNumeroPalavra($numero) {
        $hyphen      = '-';
        $conjunction = ' e ';
        $separator   = ', ';
        $negative    = 'menos ';
        $decimal     = ' ponto ';
        $dictionary  = array(
            0                   => 'zero',
            1                   => 'um',
            2                   => 'dois',
            3                   => 'três',
            4                   => 'quatro',
            5                   => 'cinco',
            6                   => 'seis',
            7                   => 'sete',
            8                   => 'oito',
            9                   => 'nove',
            10                  => 'dez',
            11                  => 'onze',
            12                  => 'doze',
            13                  => 'treze',
            14                  => 'quatorze',
            15                  => 'quinze',
            16                  => 'dezesseis',
            17                  => 'dezessete',
            18                  => 'dezoito',
            19                  => 'dezenove',
            20                  => 'vinte',
            30                  => 'trinta',
            40                  => 'quarenta',
            50                  => 'cinquenta',
            60                  => 'sessenta',
            70                  => 'setenta',
            80                  => 'oitenta',
            90                  => 'noventa',
            100                 => 'cento',
            200                 => 'duzentos',
            300                 => 'trezentos',
            400                 => 'quatrocentos',
            500                 => 'quinhentos',
            600                 => 'seiscentos',
            700                 => 'setecentos',
            800                 => 'oitocentos',
            900                 => 'novecentos',
            1000                => 'mil',
            1000000             => array('milhão', 'milhões'),
            1000000000          => array('bilhão', 'bilhões'),
            1000000000000       => array('trilhão', 'trilhões'),
            1000000000000000    => array('quatrilhão', 'quatrilhões'),
            1000000000000000000 => array('quinquilhão', 'quinquilhões')
        );

        if (!is_numeric($numero)) {
            return false;
        }

        if (($numero >= 0 && (int) $numero < 0) || (int) $numero < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words só aceita números entre ' . PHP_INT_MAX . ' à ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($numero < 0) {
            return $negative . convert_number_to_words(abs($numero));
        }

        $string = $fraction = null;

        if (strpos($numero, '.') !== false) {
            list($numero, $fraction) = explode('.', $numero);
        }

        switch (true) {
            case $numero < 21:
            $string = $dictionary[$numero];
            break;
            case $numero < 100:
            $tens   = ((int) ($numero / 10)) * 10;
            $units  = $numero % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $conjunction . $dictionary[$units];
            }
            break;
            case $numero < 1000:
            $hundreds  = floor($numero / 100)*100;
            $remainder = $numero % 100;
            $string = $dictionary[$hundreds];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
            default:
            $baseUnit = pow(1000, floor(log($numero, 1000)));
            $numBaseUnits = (int) ($numero / $baseUnit);
            $remainder = $numero % $baseUnit;
            if ($baseUnit == 1000) {
                $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[1000];
            } elseif ($numBaseUnits == 1) {
                $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit][0];
            } else {
                $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit][1];
            }
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $numero) {
                $words[] = $dictionary[$numero];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }


    public static  function formata_cpf_cnpj($cpf_cnpj){

        $cpf_cnpj = preg_replace("/[^0-9]/", "", $cpf_cnpj);
        $tipo_dado = NULL;
        if(strlen($cpf_cnpj)==11){
            $tipo_dado = "cpf";
        }
        if(strlen($cpf_cnpj)==14){
            $tipo_dado = "cnpj";
        }
        switch($tipo_dado){
            default:
            $cpf_cnpj_formatado = "Não foi possível definir tipo de dado";
            break;

            case "cpf":
            $bloco_1 = substr($cpf_cnpj,0,3);
            $bloco_2 = substr($cpf_cnpj,3,3);
            $bloco_3 = substr($cpf_cnpj,6,3);
            $dig_verificador = substr($cpf_cnpj,-2);
            $cpf_cnpj_formatado = $bloco_1.".".$bloco_2.".".$bloco_3."-".$dig_verificador;
            break;

            case "cnpj":
            $bloco_1 = substr($cpf_cnpj,0,2);
            $bloco_2 = substr($cpf_cnpj,2,3);
            $bloco_3 = substr($cpf_cnpj,5,3);
            $bloco_4 = substr($cpf_cnpj,8,4);
            $digito_verificador = substr($cpf_cnpj,-2);
            $cpf_cnpj_formatado = $bloco_1.".".$bloco_2.".".$bloco_3."/".$bloco_4."-".$digito_verificador;
            break;
        }
        return $cpf_cnpj_formatado;
    }
    
    public static function formatoReal($valor) {
        $valor = (string)$valor;
        $regra = "/^[0-9]{1,3}([,]([0-9]{3}))*[,]([.]{0})[0-9]{0,2}$/";
        if(preg_match($regra,$valor)) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkValueFormat($intValor) {
        return number_format($intValor, 2, ',', '.');

        // if($separator != null) {
        //     $data = explode($separator, $value);
        // } else {
        //     $data = explode(".", $value);
        // }
        
        // if(isset($data[1])){
        //     $num = $data[1];        
        // }else{
        //     $num = "";
        // }
        
        // switch (strlen($num)) {
        //     case 0:
        //         $num .= "00";
        //         break;
        //     case 1:
        //         $num .= "0";
        //         break;
        //     default: 
        //         $num = substr($num, 0, 2);
        // }
        
        // return $data[0].",".$num; 
    }

}
