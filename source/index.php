<?php

include_once("../include/config.php");
include_once(INCLUDE_DIR . "/" . "htmlFunctions.php");
include_once(INCLUDE_DIR . "/" . "mitigate.php");
include_once(INCLUDE_DIR . "/" . "FYP_functions.php");

session_start();

$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE );#Used till the end

$loggedIn = false;

outputHeader($loggedIn, $mysqli);

?>
		<h1>Begin</h1>

		<h2>Register</h2>
		<form action="register.php" method="post" >
			<div>
				<label for="fname" >First name:</label>
				<input type="text" name="fname" id="fname" />
			</div> 		
		
			<div>
				<label for="sname" >Surname:</label>
				<input type="text" name="sname" id="sname" />
			</div> 		
			
			<div>
				<label for="email" >Email:</label>
				<input type="text" name="email" id="email" />
			</div> 		
			
			<div>			
				<label for="pass" >Password:</label>
				<input type="password" name="pass" id="pass" />
			</div> 	
			
			<div>			
				
				<input type="submit" value="Register!" />
			</div> 		
		</form>		
		
		

		<h2>Sign-in</h2>
		<form action="login.php" method="post" >
			<div>
				<label for="email" >Email:</label>
				<input type="text" name="email" id="email" />
			</div> 		
		
			<div>
				<label for="pass" >Password:</label>
				<input type="password" name="pass" id="pass" />
			</div> 
			
			<div>			
				
				<input type="submit" value="Login!" />
			</div> 		
		</form>	

<?php
  outputFooter($loggedIn);
  $mysqli->close();
?>