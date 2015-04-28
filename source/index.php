<?php
include_once("../include/config.php");
include_once(INCLUDE_DIR . "/" . "htmlFunctions.php");
include_once(INCLUDE_DIR . "/" . "mitigate.php");
include_once(INCLUDE_DIR . "/" . "FYP_functions.php");

$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE );#Used till the end

httpsAndSessionFix($mysqli);

if( !loggedIn($mysqli) ) {
	$loggedIn = false;
}else{
	$loggedIn = true;
	header( 'Location: home.php' ) ;
	die('<p>Redirecting to non home page.');
}


outputHeader($loggedIn, $mysqli);
?>

<div class="jumbotron">
	<h1>Security Application Demonstration</h1>
	<p class="lead">This application allows you to demonstrate security vulnerabilities commonly seen on the web today</p>
	<p><a class="btn btn-lg btn-success" href="signup.php" role="button">Sign up today</a></p>
</div>

<!--
<div class="row marketing">
	<div class="col-lg-6">
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

				<input class="btn btn-lg" type="submit" value="Register!" />
			</div> 		
		</form>		
	</div>

	<div class="col-lg-6">
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

			<input class="btn btn-lg" type="submit" value="Login!" />
			</div> 		
		</form>	
	</div>
-->
	<?php
	outputFooter($loggedIn);
	$mysqli->close();
	?>