<?php
/* https://adventofcode.com/2021/day/1 */
namespace nuffy\aoc21\d01;

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
    $measurements = [];
    foreach($input as $key=>$row){
        $value = $row;
        $value += $input[$key+1] ?? 0;
        $value += $input[$key+2] ?? 0;
        $measurements[] = $value;
    }
    return solve1($measurements);
}

$input = str_getcsv(file_get_contents(__DIR__.'/input.txt'), "\n");
echo "#1: ".solve1($input).PHP_EOL;
echo "#2: ".solve2($input).PHP_EOL;
