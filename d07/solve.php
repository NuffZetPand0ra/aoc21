<?php
/* https://adventofcode.com/2021/day/7 */
namespace nuffy\aoc21\d07;

function solve1($input) : int
{
    $gas_usage = [];
    for($i = min($input); $i <= max($input); $i++){
        $gas_usage[$i] = 0;
        foreach($input as $row){
            $gas_usage[$i] += abs($row-$i);
        }
    }
    return min($gas_usage);
}
function solve2($input) : int
{
    sort($input);
    $gas_usage = [];
    $last_gas_usage = INF;
    for($i = min($input); $i <= max($input); $i++){
        $gas_usage[$i] = 0;
        foreach($input as $row){
            $gas_usage[$i] += calculateGasUsageFor2($i, $row);
        }
        if($gas_usage[$i] > $last_gas_usage){
            // One does not need to search, if one already knows the answer
            break;
        }else{
            $last_gas_usage = $gas_usage[$i];
        }
    }
    return min($gas_usage);
}

$input = str_getcsv(file_get_contents(__DIR__.'/input.txt'), ",");
echo "#1: ".solve1($input).PHP_EOL;
echo "#2: ".solve2($input).PHP_EOL;

function calculateGasUsageFor2($destination, $location){
    $distance = abs($location - $destination);
    $gas = 0;
    for($i = 0; $i <= $distance; $i++){
        $gas += $i;
    }
    return $gas;
}