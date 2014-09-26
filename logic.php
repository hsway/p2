<?php

// added this to avoid PHP warnings
date_default_timezone_set('America/New_York');

// general flow:
// pull the data from the form
// run logic on form responses
// update variables to send back
// cleanup with any helper functions

if (isset($_GET['count']) and is_numeric($_GET['count']) and $_GET['count'] > 0) {
	// echo $_GET['count'];
	$count = $_GET['count'];
} else {
	$count = 1;
}

if (isset($_GET['uppercase'])) {
	// echo $_GET['uppercase'];
	$uppercase = true;
} else {
	$uppercase = false;
}

if (isset($_GET['symbol'])) {
	// echo $_GET['symbol'];
	$symbol = true;
} else {
	$symbol = false;
}

if (isset($_GET['number'])) {
	// echo $_GET['number'];
	$number = true;
} else {
	$number = false;
}

if ($words = file('words.txt')) {
	// echo 'Count: ' . count($words) . '<br />';
	// echo $words[400];

	$selected_words = [];
	$symbols = ['!','@','#','$','%','^','&','*'];
	$numbers =[0,1,2,3,4,5,6,7,8,9];


	for ($i = 0; $i < $count; $i++) {

		// generate random number from 0 to dictionary size
		$max_words = count($words) - 1;
		$rand_word = rand(0, $max_words);

		$word = $words[$rand_word];

		// for debugging
		// echo $word . '<br />';

		array_push($selected_words, $word);
	}

	if ($uppercase) {
		// loop through words and change first letter to upper case
		foreach ($selected_words as $index => $word) {
			$selected_words[$index] = ucfirst($word);

			// for debugging
			// echo $selected_words[$index] . '<br />';
		}
	}

	// find last word in array for addition of symbol and/or number
	$last_word = $selected_words[count($selected_words) - 1];

	if ($symbol) {
		// set password to contain a symbol after last word
		$symbol_max = count($symbols) - 1;
		$rand_symbol_num = rand(0, $symbol_max);
		$rand_symbol = $symbols[$rand_symbol_num];

		$last_word .= $rand_symbol;
		// line below did not work for some reason...
		// $last_word = str_replace(' ', '', $last_word);
		$last_word = preg_replace('/\s+/','',$last_word);
		$selected_words[count($selected_words) - 1] = $last_word;
	}

	if ($number) {
		// set password to contain a number after last word
		$number_max = count($symbols) - 1;
		$rand_number_num = rand(0, $number_max);
		$rand_number = $numbers[$rand_number_num];

		$last_word .= $rand_number;
		// line below did not work for some reason...
		// $last_word = str_replace(' ', '', $last_word);
		$last_word = preg_replace('/\s+/','',$last_word);
		$selected_words[count($selected_words) - 1] = $last_word;
	}

	$password = implode("", $selected_words);
	
	// remove trailing space from password
	$password = rtrim($password);
	
	// replace spaces with dashes
	$password = preg_replace('/\s+/', '-', $password);

}

// note: no closing <?php tag