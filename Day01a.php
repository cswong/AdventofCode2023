<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

//The Problem

//Your calculation isn't quite right. It looks like some of the digits are actually spelled out with letters: one, two, three, four, five, six, seven, eight, and nine also count as valid "digits".

//Equipped with this new information, you now need to find the real first and last digit on each line. For example:

//two1nine
//eightwothree
//abcone2threexyz
//xtwone3four
//4nineeightseven2
//zoneight234
//7pqrstsixteen
//In this example, the calibration values are 29, 83, 13, 24, 42, 14, and 76. Adding these together produces 281.

//What is the sum of all of the calibration values?

//---------------------------------------

//Thought Process

//We'll tackle this similarly 
//We'll break up the dataset.
//Then loop through the dataset
//For each line I'll use regex to look at the string for digits or letters that spell digits. That will be broken into it's own array 
//I'll grab the first item of the array and set that to Variable A. Make sure to convert strings into a digit.
//I'll grab the last item of the array and set that to Variable B. Make sure to convert strings into a digit/
//Put Variable A and Variable B together to get final Result Variable C. 
//We'll add Result Variable C to Output Variable D and we should get our answer.

//Set our dataset to variable $dataset
$dataset = "two1nine
eightwothree
abcone2threexyz
xtwone3four
4nineeightseven2
zoneight234
7pqrsteightwo";

require 'dataset-day01.php';
require 'functions-day01.php';

//set our default value
$variableD = 0;

// Split the text into individual lines
$lines = explode("\n", $dataset);

//print_r($lines);
//echo "<br><br>";

//For each line in this array, we'll start parsing -- note that we should probably tokenize but I'm not as familiar with that procedure
    //$tokenize = strtok($dataset, '\n');
    //while ($tokenize = strtok(',')) {}

foreach ($lines as $calibration_values) {

    //go ahead and list out all the numbers here
    $calibration_values = replacenumbers($calibration_values);
    echo $calibration_values;
    echo "<br>";
    preg_match_all('/\d{1}/', $calibration_values, $matches); 
    print_r($matches); 
    echo "<br>";
    
    //Grab the first and last values of the array
    $variableA = $matches[0][0];    
        echo $variableA . " | ";
    $variableB = $matches[0][count($matches[0]) - 1];
        echo $variableB . " | ";
    $variableC = $variableA . $variableB;
        echo $variableC . " | ";
    $variableD = ($variableD) + ($variableC);
        echo $variableD . "<br>";
}
echo "<hr>";
echo "Final result is <b>" . $variableD;

?>