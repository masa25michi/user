
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" autocomplete="off">

	<label for="tel">Tel:</label>
	<input type="text" id="tel" name="tel" placeholder="Tel" />
	
	<label for="email">E-mail:</label>
	<input type="email" id="email" name="email" placeholder="email" />
	
	<label for="pass">Password:</label>
	<input type="pass" id="pass" name="pass" placeholder="password" />
	
	<input id="signin" type="submit" name="signIn" value="Sign In">
</form>


