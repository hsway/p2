<?php

// added this to avoid PHP warnings
date_default_timezone_set('America/New_York');

// pull the data from the form
if (isset($_GET['count']) and is_numeric($_GET['count']) and $_GET['count'] >= 1 and $_GET['count'] <= 9) {
	$count = $_GET['count'];
} else {
	// if count isn't set, isn't numeric, or is <= 0, default to 1
	$count = 1;
}

if (isset($_GET['uppercase'])) {
	$uppercase = true;
} else {
	$uppercase = false;
}

if (isset($_GET['symbol'])) {
	$symbol = true;
} else {
	$symbol = false;
}

if (isset($_GET['number'])) {
	$number = true;
} else {
	$number = false;
}

if ($words = file('words.txt')) {

	$selected_words = [];
	$symbols = ['!','@','#','$','%','^','&','*'];
	$numbers =[0,1,2,3,4,5,6,7,8,9];

	// generate an array of words of the specified size
	for ($i = 0; $i < $count; $i++) {
		// generate random number from 0 to dictionary size
		$max_words = count($words) - 1;
		$rand_word = rand(0, $max_words);

		$word = $words[$rand_word];
		array_push($selected_words, $word);
	}

	if ($uppercase) {
		// loop through words and change first letter to upper case
		foreach ($selected_words as $index => $word) {
			$selected_words[$index] = ucfirst($word);
		}
	}

	// find last word in array for addition of symbol and/or number
	$last_word = $selected_words[count($selected_words) - 1];
	// trim trailing space after last word
	$last_word = rtrim($last_word);

	if ($symbol) {
		// set password to contain a symbol after last word
		$symbol_max = count($symbols) - 1;
		$rand_symbol_num = rand(0, $symbol_max);
		$rand_symbol = $symbols[$rand_symbol_num];

		$last_word .= $rand_symbol;
	}

	if ($number) {
		// set password to contain a number after last word
		$number_max = count($symbols) - 1;
		$rand_number_num = rand(0, $number_max);
		$rand_number = $numbers[$rand_number_num];

		$last_word .= $rand_number;
	}

	// put (potentially) modified last word back into array
	$selected_words[count($selected_words) - 1] = $last_word;

	// implode array to generate password
	$password = implode('', $selected_words);
	
	// replace spaces with dashes
	$password = preg_replace('/\s+/', '-', $password);
	
}

// note: no closing <?php tag