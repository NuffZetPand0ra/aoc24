<?php
/* https://adventofcode.com/2024/day/5 */
namespace nuffy\aoc24\d05;

function solve1($input) : int
{
    $return = 0;
    list($rules, $manuals) = parse_input($input);

    foreach($manuals as $manual) {
        if(is_valid_manual($rules, $manual)) {
            $middle_page = $manual[floor(count($manual) / 2)];
            $return += $middle_page;
        }
    }
    
    return $return;
}

function solve2($input) : int
{
    $return = 0;
    list($rules, $manuals) = parse_input($input);

    foreach($manuals as $manual) {
        if(!is_valid_manual($rules, $manual)) {
            usort($manual, function($a, $b) use ($rules) {
                if(isset($rules[$a]) && in_array($b, $rules[$a])) {
                   return -1;
                }elseif(isset($rules[$b]) && in_array($a, $rules[$b])) {
                    return 1;
                }
                return 0;
            });
            $middle_page = $manual[floor(count($manual) / 2)];
            $return += $middle_page;
        }
    }

    return $return;
}

/**
 * Parse text input into rules and manuals.
 * 
 * @param string $input
 * @return array Multi-dimensional array with rules and manuals. First element is rules, second element is manuals.
 */
function parse_input(string $input) : array
{
    $input = explode("\n\n", trim($input));
    $rules_input_rows = explode("\n", $input[0]);
    $rules_input_rows = array_map(fn($r) => $rules_input_row[] = explode('|', $r), $rules_input_rows);

    $rules = [];
    foreach ($rules_input_rows as $rule_input_row) {
        $rules[$rule_input_row[0]][] = $rule_input_row[1];
    }

    $manuals = explode("\n", $input[1]);
    $manuals = array_map(fn($r) => $manual_input_row[] = explode(',', $r), $manuals);

    return [$rules, $manuals];
}

function is_valid_manual($rules, $manual) : bool
{
    foreach($manual as $pos => $page_number) {
        if(isset($rules[$page_number])) {
            foreach($rules[$page_number] as $rule) {
                $other_page_pos = array_search($rule, $manual);
                if(is_numeric($other_page_pos) && $other_page_pos < $pos) {
                    return false;
                }
            }
        }
    }

    return true;
}

$input = file_get_contents(__DIR__.'/input.txt');

echo "#1: ".solve1($input).PHP_EOL;
echo "#2: ".solve2($input).PHP_EOL;