<?php

namespace LeandroSe\ValidadorBrasil\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

/**
 * Classe para configuação de extensões para o Validation do Laravel.
 * </p>
 * Adicionar "LeandroSe\ValidadorBrasil\Provedor\LaravelValidation::class," ao
 * item "providers" no arquivo de configuração "app.php".
 *
 * @author LeandroSe <leandro@tsujiguchi.com.br>
 * @since 0.2.0
 */
class ValidadorBrasilProvider extends ServiceProvider
{

    public function boot()
    {
        Validator::extend('cnpj', '\LeandroSe\ValidadorBrasil\Validador\CNPJ@passes');
        Validator::extend('cpf', '\LeandroSe\ValidadorBrasil\Validador\CPF@passes');
    }

    public function register()
    {
    }
}
