<?php

namespace LeandroSe\ValidadorBrasil\Validador;

class CNPJTest extends \PHPUnit_Framework_TestCase
{

    public function testCNPJFormatado()
    {
        $this->assertTrue(CNPJ::validar('43.837.748/0001-56'));
    }

    public function testCNPJ()
    {
        $this->assertTrue(CNPJ::validar('43837748000156'));
        $this->assertTrue(CNPJ::validar(43837748000156));
    }

    public function testCNPJIgual()
    {
        $this->assertEquals(false, CNPJ::validar(55555555000191));
    }

    public function testCNPJSemDigitos()
    {
        $this->assertEquals(false, CNPJ::validar(438377480001));
    }
}
