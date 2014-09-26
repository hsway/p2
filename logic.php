<?php

// added this to avoid PHP warnings
date_default_timezone_set('America/New_York');

// general flow:
// pull the data from the form
// run logic on form responses
// update variables to send back
// cleanup with any helper functions

if (isset($_GET['count']) and is_numeric($_GET['count'])) {
	//echo $_GET['count'];
	$count = $_GET['count'];
} else {
	$count = 1;
}

if (isset($_GET['uppercase'])) {
	//echo $_GET['uppercase'];
	$uppercase = true;
} else {
	$uppercase = false;
}

if (isset($_GET['symbol'])) {
	//echo $_GET['symbol'];
	$symbol = true;
} else {
	$symbol = false;
}

if (isset($_GET['number'])) {
	//echo $_GET['number'];
	$number = true;
} else {
	$number = false;
}

if ($words = file('words.txt')) {
	//echo 'Count: ' . count($words) . '<br />';
	//echo $words[400];

	$selected_words = [];
	$symbols = ['!','@','#','$','%','^','&','*'];
	$numbers =[0,1,2,3,4,5,6,7,8,9];


	for ($i = 0; $i < $count; $i++) {

		// generate random number from 0 to dictionary size
		$max = count($words) - 1;
		$rand = rand(0,$max);

		$word = $words[$rand];

		// for debugging
		//echo $word . '<br />';

		array_push($selected_words, $word);
	}

	if ($uppercase) {
		// set password to uppercase
		// loop through words and change first letter to upper case
		foreach ($selected_words as $index => $word) {
			$selected_words[$index] = ucfirst($word);

			// for debugging
			//echo $selected_words[$index] . '<br />';
		}
	}

	if ($symbol) {
		// set password to contain a symbol
		// look at str_replace


	}

	if ($number) {
		// set password to contain a number

	}

	$password = implode("", $selected_words);

}

// note: not closing <?php tag