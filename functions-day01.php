<?php
//create a wordstonumber function
function wordsToNumber($data) {
    // Replace all number words with an equivalent numeric value
    $data = strtr(
        $data,
        array(
            'one'       => '1',
            'two'       => '2',
            'three'     => '3',
            'four'      => '4',
            'five'      => '5',
            'six'       => '6',
            'seven'     => '7',
            'eight'     => '8',
            'nine'      => '9',
        )
    );

    // Coerce all tokens to numbers
    $parts = array_map(
        function ($val) {
            return floatval($val);
        },
        preg_split('/[\s-]+/', $data)
    );

    $stack = new SplStack; // Current work stack
    $sum   = 0; // Running total
    $last  = null;

    foreach ($parts as $part) {
        if (!$stack->isEmpty()) {
            // We're part way through a phrase
            if ($stack->top() > $part) {
                // Decreasing step, e.g. from hundreds to ones
                if ($last >= 1000) {
                    // If we drop from more than 1000 then we've finished the phrase
                    $sum += $stack->pop();
                    // This is the first element of a new phrase
                    $stack->push($part);
                } else {
                    // Drop down from less than 1000, just addition
                    // e.g. "seventy one" -> "70 1" -> "70 + 1"
                    $stack->push($stack->pop() + $part);
                }
            } else {
                // Increasing step, e.g ones to hundreds
                $stack->push($stack->pop() * $part);
            }
        } else {
            // This is the first element of a new phrase
            $stack->push($part);
        }

        // Store the last processed part
        $last = $part;
    }

    return $sum + $stack->pop();
}


function replacenumbers($inputString) {
    $replacements = array(
        'one' => 'o1e',
        'two' => 't2o',
        'three' => 't3e',
        'four' => 'f4r',
        'five' => 'f5e',
        'six' => 's6x',
        'seven' => 's7n',
        'eight' => 'e8t',
        'nine' => 'n9e',
        
    );

    // Perform the replacements
    $outputString = str_replace(array_keys($replacements), array_values($replacements), $inputString);

    return $outputString;
}
?>