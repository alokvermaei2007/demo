<?php

//  for referenec 

//$input = array("Mark" => "P"); 
//Output: "Tournament Cancelled"
//$input = array("Raja" => "T", "Adam" => "P");
// Output: "Invalid Game"
//$input = array("Adam" => "P", "Andrew" => "P", "Chris" => "P");
//// Output: Adam
//$input = array("Adam" => "P", "Andrew" => "S", "Chris" => "R");
//// Output: Chris
//$input = array("Adam" => "P", "Andrew" => "S", "Chris" => "R", "Casey" => "P");
//// Output: Andrew
//$input = array("Adam" => "P", "Andrew" => "S", "Chris" => "R", "Casey" => "P", "Cadman" => "R");
//Output: Cadman


$op = getRPSwinner($input);

/**
 * 
 * @param type $input as array of (R,P,S) 
 * @return string as winner name
 */
function getRPSwinner($input) {
    $choices = ['0' => 'R', '1' => 'P', '2' => 'S'];
    if (count($input) <= 1) {
        print "Tournament Cancelled";
        exit;
    }
    if (!empty(array_diff(array_unique($input), $choices))) {
        print "Invalid Game";
        exit;
    }
    else {
        $values = array_chunk($input, 2, TRUE);
        foreach ($values as $key => $value) {
            $val[] = breakWinners($value);
        }
        foreach ($val as $keys => $values) {
            $winnerarray[key($values)] = $values[key($values)];
        }
        if (count($winnerarray) > 2) {
            $winner = calltosselef($winnerarray);
        }
        else {
            $winner = breakWinners($winnerarray);
        }

        print_r(key($winner));
        exit;
    }
}
/**
 * 
 * @param type $value
 * @return type
 */
function breakWinners($value) {
    if (count(array_values(array_unique($value))) < 2) {
        return array_slice($value, 0, 1);
    }
    else {
        if (empty(array_diff($value, array("P", "S")))) {
            $arr_key = array_search('S', $value);
            $w_name[$arr_key] = $value[$arr_key];
        }
        elseif (empty(array_diff($value, array("R", "S")))) {
            $arr_key = array_search('R', $value);
            $w_name[$arr_key] = $value[$arr_key];
        }
        elseif (empty(array_diff($value, array("R", "P")))) {
            $arr_key = array_search('P', $value);
            $w_name[$arr_key] = $value[$arr_key];
        }
        return $w_name;
    }
}

/**
 * 
 * @param type $input
 * @return type
 */
function calltosselef($input) {
    return getRPSwinner($input);
}
