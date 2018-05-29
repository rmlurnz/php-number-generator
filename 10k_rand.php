<?php

// This file was created by Ryan Lerner
// Friday, April 13th, 2018

// This script will generate a list of a "given amount" of numbers
// in random order each time it is run. Each number in
// the list will be unique and be between 1 and the "given amount" (inclusive).

// The key here was to NOT use any of the built-in array sorting functions.

// Execute script
// params: (minimum random value, maximum random value, number of outputs)
// in this case: (1, 10000, 10000)

execute(1, 10000, 10000);

// The "execute" procedure holds the main logic of the program.
// For sake of logical clarity and ease of refactoring, I seperated
// each step into it's own function.

function execute($min, $max, $iterations)
{
    // Array to hold generated numbers to compare newly
    // generated randoms against
    $previousNumbers = [];

    // loop to output "$iterations" number of times
    for ($i = 1; $i <= $iterations; $i++) {

        // create unique random number for iteration
        $randomNumber = generateRandomNumber($min, $max, $previousNumbers);

        // print formatted number to screen
        printf("Output #".$i.": ".$randomNumber."\n");
    }

    // For fun ;)

    printf(
        "\nEt voila! ".prettyNum($iterations)." unique random numbers between ".prettyNum($min)." and ".prettyNum($max)." (inclusive).\n\n"
    );
    printf("By Ryan Lerner - Friday, April 13th, 2018\n\n");
}

// This function accepts a minimum random value, a maximum random value,
// and an array of previously output values.  It creates a new random value
// that then gets sent off to get checked for "uniqueness".

function generateRandomNumber($min, $max, &$previousNumbers)
{
    // placeholder for new random number and it's uniqueness
    $generated;
    $isUnique = false;

    // keep creating a new random number until it is unique
    do {
        $generated = rand($min, $max);
        $isUnique = checkIfValid($generated, $previousNumbers);
    } while (!$isUnique);

    // return the new unique random number (throw exception if otherwise)
    if ($isUnique) {
        return $generated;
    } else {
        throw new \Exception("Something's fishy here...", 1);
    }
}

// This function checks the newly generated random number against
// all the other previously output numbers.  If it is unique, it gets added
// to the array and sent back as "valid"

function checkIfValid($value, &$previousNumbers)
{
    if (in_array($value, $previousNumbers)) {
        return false;
    } else {
        array_push($previousNumbers, $value);
        return true;
    }
}

// Formatter for the values in the final sentence.  Just for fun.

function prettyNum($input)
{
    return number_format($input, 0, '.', ',');
}
