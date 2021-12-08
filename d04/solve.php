<?php
/* https://adventofcode.com/2021/day/4 */
namespace nuffy\aoc21\d04;

/**
 * Solves #1
 * 
 * @param int[] $draw 
 * @param Board[] $boards 
 * @return int 
 */
function solve1(array $draw, array $boards) : int
{
    foreach($draw as $number){
        foreach($boards as $board){
            $board->markNumber($number);
            if($board->hasBingo()){
                return $board->getUnmarkedSum() * $number;
            }
        }
    }
    return 0;
}

/**
 * Solves #2
 * 
 * @param int[] $draw 
 * @param Board[] $boards 
 * @return int 
 */
function solve2(array $draw, array $boards) : int
{
    $has_bingo = [];
    foreach($draw as $number){
        foreach($boards as $i=>$board){
            $board->markNumber($number);
            if($board->hasBingo()){
                $has_bingo[$i] = true;
                if(count($has_bingo) == count($boards)){
                    return $board->getUnmarkedSum() * $number;
                }
            }
        }
    }
    return 0;
}

$splitter = "\n\n";

$input = file_get_contents(__DIR__.'/input.txt');
$draw = explode(",", substr($input, 0, strpos($input, $splitter)));
$boards_input = explode($splitter, substr($input, strpos($input, $splitter)+2));
$boards = [];
foreach($boards_input as $board){
    $boards[] = new Board(trim($board));
}

echo "#1: ".solve1($draw, $boards).PHP_EOL;
echo "#2: ".solve2($draw, $boards).PHP_EOL;

class Board
{
    private array $fields = [];

    function __construct(string $board_input)
    {
        $lines = explode("\n", $board_input);
        foreach($lines as $i=>$line){
            $fields = str_split($line, 3);
            foreach($fields as $field){
                $this->fields[$i][] = new Field((int)$field);
            }
        }
    }
    public function hasBingo() : bool
    {
        return $this->hasCompleteColumn() || $this->hasCompleteRow();
    }
    public function hasCompleteRow() : bool
    {
        foreach($this->fields as $row){
            $marked = 0;
            foreach($row as $field){
                $marked += (int)$field->isMarked();
            }
            if($marked == count($row)) return true;
        }
        return false;
    }
    public function hasCompleteColumn() : bool
    {
        for($i = 0; $i < count($this->fields[0]); $i++){
            $marked = 0;
            foreach($this->fields as $row){
                $marked += $row[$i]->isMarked();
            }
            if($marked == count($this->fields)) return true;
        }
        return false;
    }
    public function markNumber(int $number) : int
    {
        $marked = 0;
        foreach($this->fields as $row){
            foreach($row as $field){
                if($field->getNumber() == $number){
                    $field->mark();
                    $marked++;
                }
            }
        }
        return $marked;
    }
    public function getUnmarkedSum() : int
    {
        $return = 0;
        foreach($this->fields as $row){
            foreach($row as $field){
                if(!$field->isMarked()) $return += $field->getNumber();
            }
        }
        return $return;
    }
}
class Field
{
    public function __construct(
        private int $number,
        private bool $marked = false
    ){}

    public function getNumber() : int
    {
        return $this->number;
    }
    public function mark() : void
    {
        $this->marked = true;
    }
    public function isMarked() : bool
    {
        return $this->marked;
    }
}