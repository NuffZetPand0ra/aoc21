<?php
/* https://adventofcode.com/2020/day/X */
namespace nuffy\aoc20\dXX;

function solve1($input) : int
{
    $last_number = INF;
    foreach($input as $row){

    }
    return 0;
}
function solve2($input) : int
{
    return 0;
}

$input = str_getcsv(file_get_contents(__DIR__.'/input.txt'), "\n");
echo "#1: ".solve1($input).PHP_EOL;
echo "#2: ".solve2($input).PHP_EOL;
