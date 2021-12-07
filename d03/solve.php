<?php
/* https://adventofcode.com/2021/day/X */
namespace nuffy\aoc21\dXX;

function getGammaAndEpsilon($input)
{
    $registry = [];
    foreach($input as $row){
        $bits = str_split($row);
        foreach($bits as $pos=>$bit){
            if(!isset($registry[$pos][$bit])) $registry[$pos][$bit] = 0;
            $registry[$pos][$bit] += 1;
        }
    }
    $gamma = "";
    $epsilon = "";
    foreach($registry as $pos=>$bit_counts){
        if($bit_counts[0] > $bit_counts[1]){
            $gamma .= "0";
            $epsilon .= "1";
        }else{
            $gamma .= "1";
            $epsilon .= "0";
        }
    }
    $return = compact("gamma", "epsilon");
    return compact("gamma", "epsilon");
}
function solve1($input) : int
{
    $bits = getGammaAndEpsilon($input);
    return bindec($bits["gamma"]) * bindec($bits["epsilon"]);
}
function solve2($input) : int
{
    // while(count($input) > 1){
    //     $gm_ep = getGammaAndEpsilon($input);
    //     $gm_bits = str_split($gm_ep["gamma"]);
    //     foreach($input as $key=>$row){
    //         foreach($gm_bits as $gm_bit){

    //         }
    //     }
    // }
    return 0;
}

$input = str_getcsv(file_get_contents(__DIR__.'/input.txt'), "\n");
echo "#1: ".solve1($input).PHP_EOL;
echo "#2: ".solve2($input).PHP_EOL;