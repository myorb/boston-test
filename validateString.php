<?php
/*

Use PHP 5.3.

Task: 
Develop a function which validates string looking like this "[{}]"
Every opening bracket should have corresponding closing bracket of same type
"[{}]" is a correct string, "[{]}" is malformed one.


Usage: <your host>/validateString.php?i={input string}

Example: <your host>/validateString.php?i={[{{}

*/

function validateString($inputString) {
	$stack = array();
	$string = (string) $inputString;
	$bracket = ['['=>']','{'=>'}'];

	for ($i=0; $i < strlen($string); $i++) {
		$char = $string[$i];
		switch ($char) {
		 	case '[':
		 	case '{':
		 		array_push($stack, $bracket[$char]);
		 		break;
		 	case ']':
		 	case '}':
		 		array_pop($stack);
		 		break;
		 }
	}
	return $stack?FALSE:TRUE;
}

$inputString = $_GET['i'];

echo "'".$inputString."' is ";
echo validateString($inputString)?"correct":"incorrect";