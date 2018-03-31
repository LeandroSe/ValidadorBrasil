<?php

namespace LeandroSe\ValidadorBrasil\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Validador de CPF.
 *
 * @author LeandroSe <leandro@tsujiguchi.com.br>
 */
class CPF implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $value = preg_replace('/[^0-9]/', '', $value);
        if (strlen($value) != 11) {
            return false;
        }
        $arrCpf = array_reverse(str_split(substr($value, 0, 9), 1));

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

        return substr($value, 9, 11) == $v1 . $v2;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.regex') ?: 'The :attribute format is invalid.';
    }
}
