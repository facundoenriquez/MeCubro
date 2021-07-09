<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Else_;

class ForceController extends Controller
{
    /* private $array = ['ACGTTC', 'ACGAAC', 'ACTGTA', 'AGGTCA', 'AGTCAA', 'TTACGC']; */

    public function isForceUser($DNA)
    {
        $countVertical = 1;
        $countHorizontal = 1;
        $countDiagonal = 1;
        $matchVertical = 0;
        $matchHorizontal = 0;
        $matchDiagonal = 0;
        $totalMatch = 0;
        $DNA_LENGTH = 4;
        $LIMIT_TO_SEARCH = 3;


        if ($this->checkDNAcharts($DNA)) {
            $matriz = $this->MatrixInizialited($DNA);
            $totalMatch += $this->horizontalRoute($matriz);
            $totalMatch += $this->verticalRoute($matriz);
            $totalMatch += $this->diagonalRoute($matriz);
        } else {
            return "la secuencia de ADN no contiene los caracteres apropiados";
        }

        dd($matriz);
    }

    public function checkDNAcharts($array)
    {
        for ($i = 0; $i < count($array); $i++) {
            for ($j = 0; $j < strlen($array[$i]); $j++) {
                if ($array[$i][$j] != 'A' || $array[$i][$j] != 'C' || $array[$i][$j] != 'G' || $array[$i][$j] != 'T') {
                    return false;
                }
            }
        }
        return true;
    }

    public function matrixInizialited($array)
    {
        for ($i = 0; $i < count($array); $i++) {
            for ($j = 0; $j < strlen($array[$i]); $j++) {
                $matriz[$i][$j] = $array[$i][$j];
            }
        }
        return $matriz;
    }

    //RECORRIDO HORIZONAL
    public function horizontalRoute($matriz)
    {
        for ($i = 0; $i < count($matriz); $i++) {
            for ($j = 0; $j < count($matriz); $j++) {
                if ($this->countHorizontal != $this->DNA_LENGTH) {
                    if ($matriz[$i][$j] == $matriz[$i][$j + 1]) {
                        $this->countHorizontal++;
                    } else {
                        $this->countHorizontal = 1;
                    }
                } else {
                    $this->matchHorizontal++;
                    $this->countHorizontal = 1;
                }
            }
            $this->countHorizontal = 1;
        }
        return $this->matchHorizontal;
    }

    //RECORRIDO VERTICAL
    public function verticalRoute($matriz)
    {
        for ($j = 0; $j < count($matriz); $j++) {
            for ($i = 0; $i < count($matriz); $i++) {
                if ($this->countVertical != $this->DNA_LENGTH) {
                    if ($matriz[$i][$j] == $matriz[$i + 1][$j]) {
                        $this->countVertical++;
                    } else {
                        $this->countVertical = 1;
                    }
                } else {
                    $this->matchVertical++;
                    $this->countVertical = 1;
                }
            }
            $this->countVertical = 1;
        }
        return $this->matchVertical;
    }

    //RECORRIDO DIAGONAL
    public function diagonalRoute($matriz)
    {
        $searchUntil = count($matriz) - $this->LIMIT_TO_SEARCH;

        //COTA SUPERIOR Y DIAGONAL PRINCIPAL
        for ($j = 0; $j < $searchUntil; $j++) {
            $aux = 0;
            $aux2 = $j;
            for ($y = 0; $y < count($matriz) - $j; $y++) {
                if ($this->countDiagonal != $this->DNA_LENGTH) {
                    if ($matriz[$aux][$aux2] == $matriz[$aux + 1][$aux2 + 1]) {
                        $this->countDiagonal++;
                        $aux++;
                        $aux2++;
                    } else {
                        $this->countDiagonal = 1;
                        $aux++;
                        $aux2++;
                    }
                } else {
                    $this->matchDiagonal++;
                    $this->countDiagonal = 1;
                    $aux++;
                    $aux2++;
                }
            }
            $this->countDiagonal = 1;
        }
        $this->countDiagonal = 1;

        //COTA INFERIOR
        for ($i = 1; $i < $searchUntil; $i++) {
            $aux = $i;
            $aux2 = 0;
            for ($y = 0; $y < count($matriz) - $i; $y++) {
                if ($this->countDiagonal != $this->DNA_LENGTH) {
                    if ($matriz[$aux][$aux2] == $matriz[$aux + 1][$aux2 + 1]) {
                        $this->countDiagonal++;
                        $aux++;
                        $aux2++;
                    } else {
                        $this->countDiagonal = 1;
                        $aux++;
                        $aux2++;
                    }
                } else {
                    $this->matchDiagonal++;
                    $this->countDiagonal = 1;
                    $aux++;
                    $aux2++;
                }
            }
            $this->countDiagonal = 1;
        }
        $this->countDiagonal = 1;

        return $this->matchDiagonal;
    }
}
