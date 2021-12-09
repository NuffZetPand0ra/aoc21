<?php
/* https://adventofcode.com/2021/day/9 */
namespace nuffy\aoc21\d09;

function solve1($input) : int
{
    $map = parseMap($input);
    $risk_level = 0;
    foreach($map as $r=>$row){
        foreach($row as $p=>$pos){
            if(
                ($map[$r-1][$p] ?? INF) > $pos &&
                ($map[$r+1][$p] ?? INF) > $pos &&
                ($map[$r][$p-1] ?? INF) > $pos &&
                ($map[$r][$p+1] ?? INF) > $pos
            ){
                $risk_level += $pos + 1;
            }
        }
    }
    return $risk_level;
}
function solve2($input) : int
{
    $map = parseMap($input);
    return 0;
}

$input = str_getcsv(file_get_contents(__DIR__.'/input.txt'), "\n");
echo "#1: ".solve1($input).PHP_EOL;
echo "#2: ".solve2($input).PHP_EOL;

function parseMap($input) : array
{
    $map = [];
    $risk_level = 0;
    foreach($input as $r=>$row){
        foreach(str_split($row) as $pos){
            $map[$r][] = $pos;
        }
    }
    return $map;
}