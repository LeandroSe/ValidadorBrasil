<?php

namespace LeandroSe\ValidadorBrasil\Rules;

use PHPUnit\Framework\TestCase;

class CNPJTest extends TestCase
{

    public function testCNPJFormatado()
    {
        $validador = new CNPJ;
        $this->assertTrue($validador->passes('', '43.837.748/0001-56'));
    }

    public function testCNPJ()
    {
        $validador = new CNPJ;
        $this->assertTrue($validador->passes('', '43837748000156'));
        $this->assertTrue($validador->passes('', 43837748000156));
    }

    public function testCNPJIgual()
    {
        $validador = new CNPJ;
        $this->assertEquals(false, $validador->passes('', 55555555000191));
    }

    public function testCNPJSemDigitos()
    {
        $validador = new CNPJ;
        $this->assertEquals(false, $validador->passes('', 438377480001));
    }
}
