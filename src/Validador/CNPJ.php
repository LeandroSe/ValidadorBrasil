<?php

namespace LeandroSe\ValidadorBrasil\Validador;

/**
 * Validador de CNPJ.
 *
 * @author LeandroSe <leandro@tsujiguchi.com.br>
 */
class CNPJ {

    /**
     * Função para execução da validação de CNPJ.
     *
     * @param  array  $cnpj CNPJ a ser validado
     * @return boolean        true em caso de sucesso ou false caso contrario
     */
    public static function validar($cnpj)
    {
        $cnpj = preg_replace('/([0-9]{2})\.*([0-9]{3})\.*([0-9]{3})\/*([0-9]{4})-*([0-9]{2})/', '$1$2$3$4$5', $cnpj);
        if (strlen($cnpj) != 14) {
            return false;
        }
        $arrCnpj = str_split($cnpj, 1);

        if (count(array_unique(str_split(substr($cnpj, 0, 7), 1))) == 1) {
            return false;
        }

        $v1 = 0;
        $v2 = 0;

        $v1 = (5 * $arrCnpj[0]) + (4 * $arrCnpj[1])  + (3 * $arrCnpj[2])  + (2 * $arrCnpj[3]);
        $v1 += (9 * $arrCnpj[4]) + (8 * $arrCnpj[5])  + (7 * $arrCnpj[6])  + (6 * $arrCnpj[7]);
        $v1 += (5 * $arrCnpj[8]) + (4 * $arrCnpj[9]) + (3 * $arrCnpj[10]) + (2 * $arrCnpj[11]);
        $v1 = 11 - $v1 % 11;
        $v1 = $v1 > 10 ? 0 : $v1;

        $v2 = (6 * $arrCnpj[0]) + (5 * $arrCnpj[1])  + (4 * $arrCnpj[2])  + (3 * $arrCnpj[3]);
        $v2 += (2 * $arrCnpj[4]) + (9 * $arrCnpj[5])  + (8 * $arrCnpj[6])  + (7 * $arrCnpj[7]);
        $v2 += (6 * $arrCnpj[8]) + (5 * $arrCnpj[9]) + (4 * $arrCnpj[10]) + (3 * $arrCnpj[11]);
        $v2 += (2 * $arrCnpj[12]);
        $v2 = 11 - $v2 % 11;
        $v2 = $v2 > 10 ? 0 : $v2;

        return $v1 == $arrCnpj[12] && $v2 == $arrCnpj[13];
    }
}
