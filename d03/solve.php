<?php
/* https://adventofcode.com/2024/day/3 */
namespace nuffy\aoc24\d03;

function solve1($input) : int
{
    $pattern = '/mul\((\d+),(\d+)\)/';
    preg_match_all($pattern, $input, $matches, PREG_SET_ORDER);
    return array_reduce($matches, fn($acc, $match) => $acc + $match[1] * $match[2], 0);
}

function solve2($input) : int
{
    $pattern = '/don\'t\(\).*?do\(\)/s';
    $input = preg_replace($pattern, '', $input);
    return solve1($input);
}

$input = file_get_contents(__DIR__.'/input.txt');
echo "#1: ".solve1($input).PHP_EOL;
echo "#2: ".solve2($input).PHP_EOL;