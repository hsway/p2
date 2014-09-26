<?php require('logic.php'); ?>

<div class="container">

	<h1>xkcd Password Generator</h1>
	<h3>by Hank Sway for DWA15</h3><br />

	<h2>Here's a password: <span class="password"><?php echo ($password) ? $password : '' ; ?></span></h2><br />

	<h3>Make a new one:</h3>

	<form method="GET" action="/index.php"> <!-- or GET-->
		<label name="count">Number of words: </label>
		<input type="text" name="count" name="count" maxlength="1" id="count"> (max = 9)<br />
		
		<label name="uppercase">Uppercase first letter? </label>
		<input type="checkbox" name="uppercase" value="uppercase" <?php echo ($uppercase) ? 'checked="checked"' : '' ; ?>><br />
		
		<label name="symbol">Use a symbol? </label>
		<input type="checkbox" name="symbol" value="symbol" <?php echo ($symbol) ? 'checked="checked"' : '' ; ?>><br />
		
		<label name="number">Include a number? </label>
		<input type="checkbox" name="number" value="number" <?php echo ($number) ? 'checked="checked"' : '' ; ?>><br /><br />

		<input type="submit" class="btn btn-primary" value="Get your password!"/>
	</form>
</div>