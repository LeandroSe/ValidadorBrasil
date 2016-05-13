<?php

namespace LeandroSe\ValidadorBrasil\Validador;

class CPFTest extends \PHPUnit_Framework_TestCase
{

    public function testCPFFormatado()
    {
        $this->assertTrue(CPF::validar('698.810.867-01'));
        $this->assertTrue(CPF::validar(69881086701));
    }

    public function testCPF()
    {
        $this->assertTrue(CPF::validar('69881086701'));
    }

    public function testCPFIgual()
    {
        $this->assertEquals(false, CPF::validar(55555555555));
    }

    public function testCPFSemDigitos()
    {
        $this->assertEquals(false, CPF::validar(698810867));
    }
}
