<?php

namespace LeandroSe\ValidadorBrasil\Rules;

use PHPUnit\Framework\TestCase;

class CPFTest extends TestCase
{

    public function testCPFFormatado()
    {
        $validador = new CPF;
        $this->assertTrue($validador->passes('', '698.810.867-01'));
        $this->assertTrue($validador->passes('', 69881086701));
    }

    public function testCPF()
    {
        $validador = new CPF;
        $this->assertTrue($validador->passes('', '69881086701'));
    }

    public function testCPFIgual()
    {
        $validador = new CPF;
        $this->assertEquals(false, $validador->passes('', 55555555555));
    }

    public function testCPFSemDigitos()
    {
        $validador = new CPF;
        $this->assertEquals(false, $validador->passes('', 698810867));
    }
}
