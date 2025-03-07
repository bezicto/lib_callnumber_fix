<?php

function processString($input) {
    // Remove leading/trailing spaces from the input
    $trimmed = trim($input);
    $result = '';
    $i = 0;
    $length = strlen($trimmed);
    
    // Process the string character by character
    while ($i < $length) {
        if ($trimmed[$i] === '.') {
            // Look ahead to find the next non-space character
            $j = $i + 1;
            while ($j < $length && $trimmed[$j] === ' ') {
                $j++;
            }
            if ($j < $length) {
                $nextChar = $trimmed[$j];
                if (ctype_alpha($nextChar)) {
                    // Alphabet letter follows: space before period, no space after
                    $result .= ' .';
                    $result .= $nextChar;
                    $i = $j + 1; // Skip to after the letter
                } elseif (ctype_digit($nextChar)) {
                    // Digit follows: no space before period, digit directly after
                    $result .= '.';
                    $result .= $nextChar;
                    $i = $j + 1; // Skip to after the digit
                } else {
                    // Neither letter nor digit: just add the period
                    $result .= '.';
                    $i++;
                }
            } else {
                // No characters follow: just add the period
                $result .= '.';
                $i++;
            }
        } else {
            // Add non-period characters as they are
            $result .= $trimmed[$i];
            $i++;
        }
    }
    
    // Normalize spaces: replace multiple spaces with a single space
    $normalized = preg_replace('/\s+/', ' ', $result);
    
    // Trim any leading or trailing spaces
    $finalOutput = trim($normalized);
    
    return $finalOutput;
}
