<?php

namespace LeandroSe\ValidadorBrasil\Validador;

/**
 * Validador de CPF.
 *
 * @author LeandroSe <leandro@tsujiguchi.com.br>
 */
class CPF {

    /**
     * Função para execução da validação de CPF.
     *
     * @param  array  $cpf CPF a ser validado
     * @return boolean        true em caso de sucesso ou false caso contrario
     */
    public static function validar($cpf)
    {
        $cpf = preg_replace('/([0-9]{3})\.*([0-9]{3})\.*([0-9]{3})-*([0-9]{2})/', '$1$2$3$4', $cpf);
        if (strlen($cpf) != 11) {
            return false;
        }
        $arrCpf = array_reverse(str_split(substr($cpf, 0, 9), 1));

        if (count(array_unique($arrCpf)) == 1) {
            return false;
        }

        $v1 = 0;
        $v2 = 0;

        foreach ($arrCpf as $k => $i) {
            $v1 += $i * (9 - ($k % 10));
            $v2 += $i * (9 - (($k + 1) % 10));
        }
        $v1 = ($v1 % 11) % 10;
        $v2 = $v2 + $v1 * 9;
        $v2 = ($v2 % 11) % 10;

        return substr($cpf, 9, 11) == $v1 . $v2;
    }
}
