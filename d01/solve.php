<?php
/* https://adventofcode.com/2020/day/X */
namespace nuffy\aoc20\dXX;

function solve1($input) : int
{
    $last_number = 0;
    $increments = -1;
    foreach($input as $row){
        if($row > $last_number){
            $increments++;
        }
        $last_number = $row;
    }
    return $increments;
}
function solve2($input) : int
{
    $measurents = [];
    foreach($input as $key=>$row){
        $value = $row;
        $value += $input[$key+1] ?? 0;
        $value += $input[$key+2] ?? 0;
        $measurents[] = $value;
    }
    return solve1($measurents);
}

$input = str_getcsv(file_get_contents(__DIR__.'/input.txt'), "\n");
echo "#1: ".solve1($input).PHP_EOL;
echo "#2: ".solve2($input).PHP_EOL;
