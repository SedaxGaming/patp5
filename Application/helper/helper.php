<?php

function verifyLogin()
{
    if (!empty($_SESSION['userdata']) && isset($_SESSION['userdata']['password']) && isset($_SESSION['userdata']['password'])) {
        return true;
    } else {
        header('Location: '. HOME_URI . '/login');
    }
}

/**
 * Função para aplicar máscaras de R$ reais.
 * @param $valor
 * @return string
 */
function format_BRL($valor)
{
    return "R$ ".number_format($valor, 2, ",", ".");
}

/**
 * Função para váliadar CPF
 * @param null $cpf
 * @return bool
 */
function validaCPF($cpf = null)
{
    // Verifica se um número foi informado
    if (empty($cpf)) {
        return false;
    }
    
    // Elimina possivel mascara
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
    
    // Verifica se são todos números
    if (!is_numeric($cpf)) {
        return false;
    }
    
    // Verifica se o numero de digitos informados é igual a 11
    if (strlen($cpf) != 11) {
        return false;
    } elseif ($cpf == '00000000000' ||
        $cpf == '11111111111' ||
        $cpf == '22222222222' ||
        $cpf == '33333333333' ||
        $cpf == '44444444444' ||
        $cpf == '55555555555' ||
        $cpf == '66666666666' ||
        $cpf == '77777777777' ||
        $cpf == '88888888888' ||
        $cpf == '99999999999') {
        // Verifica se nenhuma das sequências invalidas abaixo
        // foi digitada. Caso afirmativo, retorna falso
        return false;
    } else {
        // Calcula os digitos verificadores para verificar se o
        // CPF é válido
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }
}


/**
 * Função para válidar CNPJ
 * @param null $cnpj
 * @return bool
 */
function validaCNPJ($cnpj = null)
{
    // Extrai os números
    $cnpj = preg_replace('/[^0-9]/is', '', $cnpj);
    
    // Valida tamanho
    if (strlen($cnpj) != 14) {
        return false;
    }
    
    // Verifica sequência de digitos repetidos. Ex: 11.111.111/111-11
    if (preg_match('/(\d)\1{13}/', $cnpj)) {
        return false;
    }
    
    // Valida dígitos verificadores
    for ($t = 12; $t < 14; $t++) {
        for ($d = 0, $m = ($t - 7), $i = 0; $i < $t; $i++) {
            $d += $cnpj[$i] * $m;
            $m = ($m == 2 ? 9 : --$m);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cnpj[$i] != $d) {
            return false;
        }
    }
    return true;
}

/**
 * Função que verifica se o request é um POST
 * @return bool
 */
function requestIsPOST()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        return true;
    }
    return false;
}

/**
 * Função para aplicar máscaras.
 * @param $mask
 * @param $str
 * @return mixed
 */
function Mask($mask,$str)
{
    $str = str_replace(" ","",$str);
    
    for($i=0;$i<strlen($str);$i++){
        $mask[strpos($mask,"#")] = $str[$i];
    }
    
    return $mask;
}
