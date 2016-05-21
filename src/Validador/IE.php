<?php

namespace LeandroSe\ValidadorBrasil\Validador;

/**
 * Classe de validação de IE.
 *
 * @author LeandroSe <leandro@tsujiguchi.com.br>
 */
class IE
{

    /**
    * Função para execução da validação de CPF.
    *
    * @param  string $ie IE a ser validado
    * @param  string $uf UF a ser validado
    * @return boolean    true em caso de sucesso ou false caso contrario
    */
    public static function validar($ie, $uf)
    {
        if (strtoupper($ie) == 'ISENTO') {
            return true;
        } else {
            $uf = strtoupper($uf);
            $ie = ereg_replace('[()-./,:]', '', $ie);

            $fnc = 'ie' . $uf;
            return IE::$fnc($ie);
        }
    }

    protected static function ieAC($ie)
    {
        if (strlen($ie) != 13) {
            return false;
        } else {
            if (substr($ie, 0, 2) != '01') {
                return false;
            } else {
                $pesos = [4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
                $soma = 0;
                foreach ($pesos as $i => $peso) {
                    $soma += $ie[$i] * $peso;
                }
                $dig = 11 - ($soma % 11);
                if ($dig >= 10) {
                    $dig = 0;
                }
                if (!($dig == $ie[11])) {
                    return false;
                } else {
                    $pesos = [5,4,3,2,9,8,7,6,5,4,3,2];
                    $soma = 0;
                    foreach ($pesos as $i => $peso) {
                        $soma += $ie[$i] * $peso;
                    }
                    $dig = 11 - ($soma % 11);
                    if ($dig >= 10) {
                        $dig = 0;
                    }

                    return ($dig == $ie[12]);
                }
            }
        }
    }

    protected static function ieAL($ie)
    {
        if (strlen($ie) != 9) {
            return false;
        } else {
            if (substr($ie, 0, 2) != '24') {
                return false;
            } else {
                $pesos = [9, 8, 7, 6, 5, 4, 3, 2];
                $soma = 0;
                foreach ($pesos as $i => $peso) {
                    $soma += $ie[$i] * $peso;
                }
                $soma *= 10;
                $dig = $soma - (((int)($soma / 11)) * 11);
                if ($dig == 10) {
                    $dig = 0;
                }

                return ($dig == $ie[8]);
            }
        }
    }

    protected static function ieAM($ie)
    {
        if (strlen($ie) != 9) {
            return false;
        } else {
            $pesos = [9, 8, 7, 6, 5, 4, 3, 2];
            $soma = 0;
            foreach ($pesos as $i => $peso) {
                $soma += $ie[$i] * $peso;
            }
            if ($soma <= 11) {
                $dig = 11 - $soma;
            } else {
                $r = $soma % 11;
                if ($r <= 1) {
                    $dig = 0;
                } else {
                    $dig = 11 - $r;
                }
            }

            return ($dig == $ie[8]);
        }
    }

    protected static function ieAP($ie)
    {
        if (strlen($ie) != 9) {
            return false;
        } else {
            if (substr($ie, 0, 2) != '03') {
                return false;
            } else {
                $i = substr($ie, 0, -1);
                if (($i >= 3000001) && ($i <= 3017000)) {
                    $p = 5;
                    $d = 0;
                } elseif (($i >= 3017001) && ($i <= 3019022)) {
                    $p = 9;
                    $d = 1;
                } elseif ($i >= 3019023) {
                    $p = 0;
                    $d = 0;
                }

                $pesos = [9, 8, 7, 6, 5, 4, 3, 2];
                $soma = $p;
                foreach ($pesos as $i => $peso) {
                    $soma += $ie[$i] * $peso;
                }
                $dig = 11 - ($soma % 11);
                if ($dig == 10) {
                    $dig = 0;
                } elseif ($dig == 11) {
                    $dig = $d;
                }

                return ($dig == $ie[8]);
            }
        }
    }

    protected static function ieBA($ie)
    {
        if (strlen($ie) != 8 && strlen($ie) != 9) {
            return false;
        } else {
            if (strlen($ie) == 8) {
                $i = substr($ie, 0, 1);
                $casas = 5;
                $pesos1 = [7, 6, 5, 4, 3, 2];
                $dv1 = 6;
                $pesos2 = [8, 7, 6, 5, 4, 3, 0, 2];
                $dv2 = 7;
            } else {
                $i = substr($ie, 1, 1);
                $casas = 6;
                $pesos1 = [8, 7, 6, 5, 4, 3, 2];
                $dv1 = 7;
                $pesos2 = [9, 8, 7, 6, 5, 4, 3, 0, 2];
                $dv2 = 8;
            }

            if (in_array($i, ['0', '1', '2', '3', '4', '5', '8'])) {
                $modulo = 10;
            } elseif (in_array($i, ['6', '7', '9'])) {
                $modulo = 11;
            }

            $soma = 0;
            foreach ($pesos1 as $i => $peso) {
                $soma += $ie[$i] * $peso;
            }

            $i = $soma % $modulo;
            if ($modulo == 10) {
                if ($i == 0) {
                    $dig = 0;
                } else {
                    $dig = $modulo - $i;
                }
            } else {
                if ($i <= 1) {
                    $dig = 0;
                } else {
                    $dig = $modulo - $i;
                }
            }
            if (!($dig == $ie[$dv2])) {
                return false;
            } else {
                $b = 3;
                $soma = 0;
                foreach ($pesos2 as $i => $peso) {
                    $soma += $ie[$i] * $peso;
                }
                $i = $soma % $modulo;
                if ($modulo == 10) {
                    if ($i == 0) {
                        $dig = 0;
                    } else {
                        $dig = $modulo - $i;
                    }
                } else {
                    if ($i <= 1) {
                        $dig = 0;
                    } else {
                        $dig = $modulo - $i;
                    }
                }

                return ($dig == $ie[$dv1]);
            }
        }
    }

    protected static function ieCE($ie)
    {
        if (strlen($ie) != 9) {
            return false;
        } else {
            $pesos = [9, 8, 7, 6, 5, 4, 3, 2];
            $soma = 0;
            foreach ($pesos as $i => $peso) {
                $soma += $ie[$i] * $peso;
            }
            $dig = 11 - ($soma % 11);

            if ($dig >= 10) {
                $dig = 0;
            }

            return ($dig == $ie[8]);
        }
    }

    protected static function ieDF($ie)
    {
        if (strlen($ie) != 13) {
            return false;
        } else {
            if (substr($ie, 0, 2) != '07') {
                return false;
            } else {
                $pesos = [4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
                $soma = 0;
                foreach ($pesos as $i => $peso) {
                    $soma += $ie[$i] * $peso;
                }
                $dig = 11 - ($soma % 11);
                if ($dig >= 10) {
                    $dig = 0;
                }

                if (!($dig == $ie[11])) {
                    return false;
                } else {
                    $pesos = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
                    $soma = 0;
                    foreach ($pesos as $i => $peso) {
                        $soma += $ie[$i] * $peso;
                    }
                    $dig = 11 - ($soma % 11);
                    if ($dig >= 10) {
                        $dig = 0;
                    }

                    return ($dig == $ie[12]);
                }
            }
        }
    }

    protected static function ieES($ie)
    {
        if (strlen($ie) != 9) {
            return false;
        } else {
            $pesos = [9, 8, 7, 6, 5, 4, 3, 2];
            $soma = 0;
            foreach ($pesos as $i => $peso) {
                $soma += $ie[$i] * $peso;
            }
            $i = $soma % 11;
            if ($i < 2) {
                $dig = 0;
            } else {
                $dig = 11 - $i;
            }

            return ($dig == $ie[8]);
        }
    }

    protected static function ieGO($ie)
    {
        if (strlen($ie) != 9) {
            return false;
        } else {
            $s = substr($ie, 0, 2);

            if (!(($s == 10) || ($s == 11) || ($s == 15))) {
                return false;
            } else {
                $n = substr($ie, 0, 8);

                if ($n == 11094402) {
                    return $ie[8] == 0 || $ie[8] == 1;
                } else {
                    $pesos = [9, 8, 7, 6, 5, 4, 3, 2];
                    $soma = 0;
                    foreach ($pesos as $i => $peso) {
                        $soma += $ie[$i] * $peso;
                    }
                    $i = $soma % 11;
                    if ($i == 0) {
                        $dig = 0;
                    } else {
                        if ($i == 1) {
                            if (($n >= 10103105) && ($n <= 10119997)) {
                                $dig = 1;
                            } else {
                                $dig = 0;
                            }
                        } else {
                            $dig = 11 - $i;
                        }
                    }

                    return ($dig == $ie[8]);
                }
            }
        }
    }

    protected static function ieMA($ie)
    {
        if (strlen($ie) != 9) {
            return false;
        } else {
            if (substr($ie, 0, 2) != 12) {
                return false;
            } else {
                $pesos = [9, 8, 7, 6, 5, 4, 3, 2];
                $soma = 0;
                foreach ($pesos as $i => $peso) {
                    $soma += $ie[$i] * $peso;
                }
                $i = $soma % 11;
                if ($i <= 1) {
                    $dig = 0;
                } else {
                    $dig = 11 - $i;
                }

                return ($dig == $ie[8]);
            }
        }
    }

    protected static function ieMT($ie)
    {
        if (strlen($ie) != 11) {
            return false;
        } else {
            $pesos = [3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
            $soma = 0;
            foreach ($pesos as $i => $peso) {
                $soma += $ie[$i] * $peso;
            }
            $i = $soma % 11;
            if ($i <= 1) {
                $dig = 0;
            } else {
                $dig = 11 - $i;
            }

            return ($dig == $ie[10]);
        }
    }

    protected static function ieMS($ie)
    {
        if (strlen($ie) != 9) {
            return false;
        } else {
            if (substr($ie, 0, 2) != 28) {
                return false;
            } else {
                $pesos = [9, 8, 7, 6, 5, 4, 3, 2];
                $soma = 0;
                foreach ($pesos as $i => $peso) {
                    $soma += $ie[$i] * $peso;
                }
                $i = $soma % 11;
                if ($i == 0) {
                    $dig = 0;
                } else {
                    $dig = 11 - $i;
                }

                if ($dig > 9) {
                    $dig = 0;
                }

                return ($dig == $ie[8]);
            }
        }
    }

    protected static function ieMG($ie)
    {
        if (strlen($ie) != 13) {
            return false;
        } else {
            $ie2 = substr($ie, 0, 3) . '0' . substr($ie, 3);

            $pesos = [1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2];
            $soma = "";
            foreach ($pesos as $i => $peso) {
                $soma .= $ie2[$i] * $peso;
            }
            $s = 0;
            for ($i = 0; $i<strlen($soma); $i++) {
                $s += $soma[$i];
            }
            $i = (substr($s, 0, 1) + 1) . '0';
            $dig = $i - $s;
            if ($dig != $ie[11]) {
                return false;
            } else {
                $pesos = [3, 2, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2];
                $soma = 0;
                foreach ($pesos as $i => $peso) {
                    $soma += $ie[$i] * $peso;
                }
                $i = $soma % 11;
                if ($i < 2) {
                    $dig = 0;
                } else {
                    $dig = 11 - $i;
                };

                return ($dig == $ie[12]);
            }
        }
    }

    protected static function iePA($ie)
    {
        if (strlen($ie) != 9) {
            return false;
        } else {
            if (substr($ie, 0, 2) != 15) {
                return false;
            } else {
                $pesos = [9, 8, 7, 6, 5, 4, 3, 2];
                $soma = 0;
                foreach ($pesos as $i => $peso) {
                    $soma += $ie[$i] * $peso;
                }
                $i = $soma % 11;
                if ($i <= 1) {
                    $dig = 0;
                } else {
                    $dig = 11 - $i;
                }

                return ($dig == $ie[8]);
            }
        }
    }

    protected static function iePB($ie)
    {
        if (strlen($ie) != 9) {
            return false;
        } else {
            $pesos = [9, 8, 7, 6, 5, 4, 3, 2];
            $soma = 0;
            foreach ($pesos as $i => $peso) {
                $soma += $ie[$i] * $peso;
            }
            $i = $soma % 11;
            if ($i <= 1) {
                $dig = 0;
            } else {
                $dig = 11 - $i;
            }

            if ($dig > 9) {
                $dig = 0;
            }

            return ($dig == $ie[8]);
        }
    }

    protected static function iePR($ie)
    {
        if (strlen($ie) != 10) {
            return false;
        } else {
            $pesos = [3, 2, 7, 6, 5, 4, 3, 2];
            $soma = 0;
            foreach ($pesos as $i => $peso) {
                $soma += $ie[$i] * $peso;
            }
            $i = $soma % 11;
            if ($i <= 1) {
                $dig = 0;
            } else {
                $dig = 11 - $i;
            }

            if (!($dig == $ie[8])) {
                return false;
            } else {
                $b = 4;
                $soma = 0;
                for ($i = 0; $i <= 8; $i++) {
                    $soma += $ie[$i] * $b;
                    $b--;
                    if ($b == 1) {
                        $b = 7;
                    }
                }
                $i = $soma % 11;
                if ($i <= 1) {
                    $dig = 0;
                } else {
                    $dig = 11 - $i;
                }

                return ($dig == $ie[9]);
            }
        }
    }

    protected static function iePE($ie)
    {
        if (strlen($ie) == 9) {
            $pesos = [8, 7, 6, 5, 4, 3, 2];
            $soma = 0;
            foreach ($pesos as $i => $peso) {
                $soma += $ie[$i] * $peso;
            }
            $i = $soma % 11;
            if ($i <= 1) {
                $dig = 0;
            } else {
                $dig = 11 - $i;
            }

            if (!($dig == $ie[7])) {
                return false;
            } else {
                $pesos = [9, 8, 7, 6, 5, 4, 3, 2];
                $soma = 0;
                foreach ($pesos as $i => $peso) {
                    $soma += $ie[$i] * $peso;
                }
                $i = $soma % 11;
                if ($i <= 1) {
                    $dig = 0;
                } else {
                    $dig = 11 - $i;
                }

                return ($dig == $ie[8]);
            }
        } elseif (strlen($ie) == 14) {
            $pesos = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
            $soma = 0;
            foreach ($pesos as $i => $peso) {
                $soma += $ie[$i] * $peso;
            }
            $dig = 11 - ($soma % 11);
            if ($dig > 9) {
                $dig = $dig - 10;
            }

            return ($dig == $ie[13]);
        } else {
            return false;
        }
    }

    protected static function iePI($ie)
    {
        if (strlen($ie) != 9) {
            return false;
        } else {
            $pesos = [9, 8, 7, 6, 5, 4, 3, 2];
            $soma = 0;
            foreach ($pesos as $i => $peso) {
                $soma += $ie[$i] * $peso;
            }
            $i = $soma % 11;
            $dig = 11 - $i;
            if ($dig >= 10) {
                $dig = 0;
            }

            return ($dig == $ie[8]);
        }
    }

    protected static function ieRJ($ie)
    {
        if (strlen($ie) != 8) {
            return false;
        } else {
            $pesos = [2, 7, 6, 5, 4, 3, 2];
            $soma = 0;
            foreach ($pesos as $i => $peso) {
                $soma += $ie[$i] * $peso;
            }
            $i = $soma % 11;
            if ($i <= 1) {
                $dig = 0;
            } else {
                $dig = 11 - $i;
            }

            return ($dig == $ie[7]);
        }
    }

    protected static function ieRN($ie)
    {
        if (!((strlen($ie) == 9) || (strlen($ie) == 10))) {
            return false;
        } else {
            $b = strlen($ie);
            if ($b == 9) {
                $pesos = [9, 8, 7, 6, 5, 4, 3, 2];
                $s = 7;
            } else {
                $pesos = [10, 9, 8, 7, 6, 5, 4, 3, 2];
                $s = 8;
            }
            $soma = 0;
            foreach ($pesos as $i => $peso) {
                $soma += $ie[$i] * $peso;
            }
            $soma *= 10;
            $dig = $soma % 11;
            if ($dig == 10) {
                $dig = 0;
            }

            $s += 1;
            return ($dig == $ie[$s]);
        }
    }

    protected static function ieRS($ie)
    {
        if (strlen($ie) != 10) {
            return false;
        } else {
            $pesos = [2, 9, 8, 7, 6, 5, 4, 3, 2];
            $soma = 0;
            foreach ($pesos as $i => $peso) {
                $soma += $ie[$i] * $peso;
            }
            $dig = 11 - ($soma % 11);
            if ($dig >= 10) {
                $dig = 0;
            }

            return ($dig == $ie[9]);
        }
    }

    protected static function ieRO($ie)
    {
        if (strlen($ie) == 9) {
            $pesos = [6, 5, 4, 3, 2];
            $soma = 0;
            foreach ($pesos as $i => $peso) {
                $soma += $ie[$i] * $peso;
            }
            $dig = 11 - ($soma % 11);
            if ($dig >= 10) {
                $dig = $dig - 10;
            }

            return ($dig == $ie[8]);
        } elseif (strlen($ie) == 14) {
            $pesos = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
            $soma = 0;
            foreach ($pesos as $i => $peso) {
                $soma += $ie[$i] * $peso;
            }
            $dig = 11 - ($soma % 11);
            if ($dig > 9) {
                $dig = $dig - 10;
            }

            return ($dig == $ie[13]);
        } else {
            return false;
        }
    }

    protected static function ieRR($ie)
    {
        if (strlen($ie) != 9) {
            return false;
        } else {
            if (substr($ie, 0, 2) != 24) {
                return false;
            } else {
                $pesos = [1, 2, 3, 4, 5, 6, 7, 8];
                $soma = 0;
                foreach ($pesos as $i => $peso) {
                    $soma += $ie[$i] * $peso;
                }
                $dig = $soma % 9;

                return ($dig == $ie[8]);
            }
        }
    }

    protected static function ieSC($ie)
    {
        if (strlen($ie) != 9) {
            return false;
        } else {
            $pesos = [9, 8, 7, 6, 5, 4, 3, 2];
            $soma = 0;
            foreach ($pesos as $i => $peso) {
                $soma += $ie[$i] * $peso;
            }
            $dig = 11 - ($soma % 11);
            if ($dig <= 1) {
                $dig = 0;
            }

            return ($dig == $ie[8]);
        }
    }

    protected static function ieSP($ie)
    {
        if (strtoupper(substr($ie, 0, 1))  == 'P') {
            if (strlen($ie) != 13) {
                return false;
            } else {
                $pesos = [1, 3, 4, 5, 6, 7, 8, 10];
                $soma = 0;
                foreach ($pesos as $i => $peso) {
                    $soma += $ie[$i] * $peso;
                }
                $dig = $soma % 11;
                return ($dig == $ie[9]);
            }
        } else {
            if (strlen($ie) != 12) {
                return false;
            } else {
                $soma = 0;
                $pesos = [1, 3, 4, 5, 6, 7, 8, 10];
                foreach ($pesos as $i => $peso) {
                    $soma += $ie[$i] * $peso;
                }
                $dig = $soma % 11;
                if ($dig > 9) {
                    $dig = 0;
                }

                if ($dig != $ie[8]) {
                    return false;
                } else {
                    $soma = 0;
                    $pesos = [3, 2, 10, 9, 8, 7, 6, 5, 4, 3, 2];
                    foreach ($pesos as $i => $peso) {
                        $soma += $ie[$i] * $peso;
                    }
                    $dig = $soma % 11;
                    if ($dig > 9) {
                        $dig = 0;
                    }

                    return ($dig == $ie[11]);
                }
            }
        }
    }

    protected static function ieSE($ie)
    {
        if (strlen($ie) != 9) {
            return false;
        } else {
            $pesos = [9, 8, 7, 6, 5, 4, 3, 2];
            $soma = 0;
            foreach ($pesos as $i => $peso) {
                $soma += $ie[$i] * $peso;
            }
            $dig = 11 - ($soma % 11);
            if ($dig > 9) {
                $dig = 0;
            }

            return ($dig == $ie[8]);
        }
    }

    protected static function ieTO($ie)
    {
        if (strlen($ie) != 11) {
            return false;
        } else {
            $s = substr($ie, 2, 2);
            if (!(($s=='01') || ($s=='02') || ($s=='03') || ($s=='99'))) {
                return false;
            } else {
                $pesos = [9, 8, 0, 0, 7, 6, 5, 4, 3, 2];
                $soma = 0;
                foreach ($pesos as $i => $peso) {
                    $soma += $ie[$i] * $peso;
                }
                $i = $soma % 11;
                if ($i < 2) {
                    $dig = 0;
                } else {
                    $dig = 11 - $i;
                }

                return ($dig == $ie[10]);
            }
        }
    }
}
