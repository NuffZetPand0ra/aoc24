<?php
/* https://adventofcode.com/2024/day/2 */
namespace nuffy\aoc24\d02;

function solve1($input) : int
{
    $safe_reports = 0;
    foreach($input as $row){
        $row = explode(" ", $row);
        if(is_safe($row)){
            $safe_reports++;
        }
    }
    return $safe_reports;
}

function solve2($input) : int
{
    $safe_reports = 0;
    foreach($input as $row){
        $row = explode(" ", $row);
        foreach($row as $key=>$value){
            $row_copy = [...$row];
            array_splice($row_copy, $key, 1);
            if(is_safe($row_copy)){
                $safe_reports++;
                break;
            }
        }
    }
    return $safe_reports;
}

function is_safe(array $levels){
    $is_safe = true;
    $direction = $levels[0] < $levels[1] ? 'up' : 'down';
    $prev = $direction == 'up' ? $levels[0]-1 : $levels[0]+1;
    $safety_ranges = ['min'=>1, 'max'=>3];

    foreach($levels as $level){
        if($direction == 'up'){
            if(in_array($level, range($prev+$safety_ranges['min'], $prev+$safety_ranges['max']))){
                $prev = $level;
            }else{
                $is_safe = false;
                break;
            }
        }else{
            if(in_array($level, range($prev-$safety_ranges['max'], $prev-$safety_ranges['min']))){
                $prev = $level;
            }else{
                $is_safe = false;
                break;
            }
        }
    }

    return $is_safe;
}

$input = str_getcsv(file_get_contents(__DIR__.'/input.txt'), "\n");
// $input = str_getcsv('7 6 4 2 1
// 1 2 7 8 9
// 9 7 6 2 1
// 1 3 2 4 5
// 8 6 4 4 1
// 1 3 6 7 9', "\n");
echo "#1: ".solve1($input).PHP_EOL;
echo "#2: ".solve2($input).PHP_EOL;