<?php
/* https://adventofcode.com/2021/day/2 */
namespace nuffy\aoc21\d02;

class Submarine
{
    public $x_pos = 0;
    public $z_pos = 0;
    public $aim = 0;

    function move($dir, $amount)
    {
        switch($dir){
            case "up":
                $this->x_pos -= $amount;
                break;
            case "down":
                $this->x_pos += $amount;
                break;
            case "forward":
                $this->z_pos += $amount;
                break;
        }
    }

    function changeAim($dir, $amount)
    {
        switch($dir)
        {
            case "up":
                $this->aim -= $amount;
                break;
            case "down":
                $this->aim += $amount;
                break;
            case "forward":
                $this->z_pos += $amount;
                $this->x_pos += $amount * $this->aim;
                break;
        }
    }
}

function solve1($input) : int
{
    $sub = new Submarine;
    foreach($input as $instruction){
        list($direction, $amount) = explode(" ", $instruction);
        $sub->move($direction, $amount);
    }
    return $sub->z_pos * $sub->x_pos;
}
function solve2($input) : int
{
    $sub = new Submarine;
    foreach($input as $instruction){
        list($direction, $amount) = explode(" ", $instruction);
        $sub->changeAim($direction, $amount);
    }
    return $sub->z_pos * $sub->x_pos;
}

$input = str_getcsv(file_get_contents(__DIR__.'/input.txt'), "\n");
echo "#1: ".solve1($input).PHP_EOL;
echo "#2: ".solve2($input).PHP_EOL;
