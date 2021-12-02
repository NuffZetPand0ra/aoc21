<?php
namespace nuffy\aoc21;

$folders = scandir(__DIR__);
foreach($folders as $folder){
    if(preg_match('/d\d{2}/', $folder) && file_exists(__DIR__."/$folder/solve.php")){
        echo "$folder:\n";
        include __DIR__."/$folder/solve.php";
        echo "----\n";
    }
}

if(file_exists(__DIR__.'/.config')){
    echo "Current score:\n".getLeaderboard()."---\n";
}

function getLeaderboard() : string
{
    $conf = parse_ini_file(__DIR__.'/.config');
    $curl = curl_init("https://adventofcode.com/2021/leaderboard/private/view/".$conf['LEADERBOARD_ID'].".json");
    curl_setopt($curl, CURLOPT_COOKIE, "session=".$conf['SESSION_ID']);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $res = curl_exec($curl);
    try{
        $data = json_decode($res);
        $members = (array)$data->members;
    }catch(\Exception $e){
        throw new \Exception ("Response from AOC was not json.", 0, $e);
    }
    usort($members, function($a, $b){
        if($b->stars == $a->stars){
            return $b->local_score <=> $a->local_score;
        }
        return $b->stars <=> $a->stars;
    });
    $leaderboard = '';
    foreach($members as $member){
        $leaderboard .= "{$member->name} - {$member->stars} stars - {$member->local_score} points\n";
    }
    return $leaderboard;
}