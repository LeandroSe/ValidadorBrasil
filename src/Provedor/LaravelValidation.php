<?php

namespace LeandroSe\ValidadorBrasil\Provedor;

use Validator;
use Illuminate\Support\ServiceProvider;
use LeandroSe\ValidadorBrasil\Validador\CNPJ;
use LeandroSe\ValidadorBrasil\Validador\CPF;

/**
 * Classe para configuação de extensões para o Validation do Laravel.
 * </p>
 * Adicionar "LeandroSe\ValidadorBrasil\Provedor\LaravelValidation::class," ao
 * item "providers" no arquivo de configuração "app.php".
 *
 * @author LeandroSe <leandro@tsujiguchi.com.br>
 * @since 0.2.0
 */
class LaravelValidation extends ServiceProvider
{

    public function boot()
    {
        Validator::extend('cnpj', function($attribute, $value, $parameters, $validator) {
            $validator->setCustomMessages(['cnpj' => 'O campo :attribute não possui um CNPJ válido.']);
            return CNPJ::validar($value);
        });
        Validator::extend('cpf', function($attribute, $value, $parameters, $validator) {
            $validator->setCustomMessages(['cpf' => 'O campo :attribute não possui um CPF válido.']);
            return CPF::validar($value);
        });
    }

    public function register()
    {
    }
}
