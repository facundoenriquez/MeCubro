<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForceController extends Controller
{

    public function isForceUser()
    {
        /* if ($this->checkDNAcharts($DNA)) { */
        /* $this->MatrixInizialited(); */

        $array = ['ACGTTC', 'ACGAAC', 'ACTGTA', 'AGGTCA', 'AGTCAA', 'TTACGC'];
        for ($i = 0; $i < count($array); $i++) {
            for ($j = 0; $j < strlen($array[$i]); $j++) {
                $matriz[$i][$j] = $array[$i][$j];
            }
        }

        for ($j = 0; $j < count($matriz); $j++) {
            for ($i = 0; $i < count($matriz); $i++) {
                $letra = $matriz[$j][$i];
                if ($letra == $matriz[$j][$i+1]) {
                    
                }
                $matriz[$j][$i];
            }
        }

        /* } */

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

    public function matrixInizialited()
    {
        /* for ($i = 0; $i < count($array); $i++) {
            for ($j = 0; $j < strlen($array[$i]); $j++) {
                $matriz[$i][$j] = $array[$i][$j];
            }
        } */
        return $matriz;
    }
}
