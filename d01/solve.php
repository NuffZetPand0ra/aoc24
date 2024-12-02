<?php
/* https://adventofcode.com/2024/day/1 */
namespace nuffy\aoc24\d01;

function solve1($input) : int
{
    /**
     * Maybe the lists are only off by a small amount! To find out, pair up the numbers and measure how far apart they are. Pair up the smallest number in the left list with the smallest number in the right list, then the second-smallest left number with the second-smallest right number, and so on.
     */
    $cols = ['left'=>[], 'right'=>[]];
    foreach($input as $row){
        $row = explode("   ", $row);
        $cols['left'][] = $row[0];
        $cols['right'][] = $row[1];
    }
    sort($cols['left']);
    sort($cols['right']);

    $diffs = [];

    foreach($cols['left'] as $i=>$left){
        $right = $cols['right'][$i];
        $diffs[] = abs($left - $right);
    }

    return array_sum($diffs);
}

function solve2($input) : int
{
    /**
     * The Historians can't agree on which group made the mistakes or how to read most of the Chief's handwriting, but in the commotion you notice an interesting detail: a lot of location IDs appear in both lists! Maybe the other numbers aren't location IDs at all but rather misinterpreted handwriting.
     * 
     * This time, you'll need to figure out exactly how often each number from the left list appears in the right list. Calculate a total similarity score by adding up each number in the left list after multiplying it by the number of times that number appears in the right list.
     */
    $cols = ['left'=>[], 'right'=>[]];
    foreach($input as $row){
        $row = explode("   ", $row);
        $cols['left'][] = $row[0];
        $cols['right'][] = $row[1];
    }

    $similarity_scores = [];

    foreach($cols['left'] as $left){
        $similar_numbers = [];
        foreach($cols['right'] as $right){
            if($left == $right){
                $similar_numbers[] = $right;
            }
        }
        $similarity_scores[] = $left * count($similar_numbers);
    }

    return array_sum($similarity_scores);
}

$input = str_getcsv(file_get_contents(__DIR__.'/input.txt'), "\n");
echo "#1: ".solve1($input).PHP_EOL;
echo "#2: ".solve2($input).PHP_EOL;