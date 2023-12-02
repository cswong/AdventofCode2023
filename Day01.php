<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

//The Problem

//The newly-improved calibration document consists of lines of text; each line originally contained a specific calibration value that the Elves now //need to recover. On each line, the calibration value can be found by combining the first digit and the last digit (in that order) to form a single //two-digit number.

//For example:

//1abc2
//pqr3stu8vwx
//a1b2c3d4e5f
//treb7uchet
//In this example, the calibration values of these four lines are 12, 38, 15, and 77. Adding these together produces 142.


//So what we're looking here to do is string parse from the left, find the first number, set that to Variable A. 
//Then string parse the original string from the right and look for the first number and set that to Variable B.
//Put Variable A and Variable B together to get final Result Variable C. 
//We'll add Result Variable C to Output Variable D and we should get our answer.

//Set our datatext to variable $datatext
$datatext = "1abc2
pqr3stu8vwx
a1b2c3d4e5f
treb7uchet";

//set our default value
$variableD = 0;

// Split the text into individual lines
$lines = explode("\n", $datatext);

print_r($lines);
echo "<br><br>";

//For each line in this array, we'll start parsing -- note that we should probably tokenize but I'm not as familiar with that procedure
	//$tokenize = strtok($datatext, '\n');
	//while ($tokenize = strtok(',')) {}

foreach ($lines as $calibration_values) {

	//go ahead and list out all the numbers here
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
