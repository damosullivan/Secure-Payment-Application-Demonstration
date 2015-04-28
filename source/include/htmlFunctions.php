<?php

function outputHeader($loggedIn, $mysqli=null){
	echo <<<HTML
	<?xml version="1.0" encoding="UTF-8"?>
	<!DOCTYPE html 
	PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Secure Payment Application Demonstration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link type="text/css" href="../stylesheet.css" rel="stylesheet" />
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link rel="shortcut icon" href="favicon.ico" />
HTML;
		echo mitigate($mysqli, "frameBlock");
		echo mitigate($mysqli, "frameBlockingLegacy"); 
		echo <<<HTML

	</head>
HTML;

if(mitigateBool($mysqli, 'dashboard')){
	echo '<body onLoad="trythis(0);" >';
}else{
	echo '<body>';
}

	
	echo <<<HTML
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="../bootstrap/js/bootstrap.min.js"></script>
HTML;
    #
		echo '<div id="container" >';

		if($loggedIn){
			echo '<div class="header">';#class="active"
			#( (strpos($_SERVER['PHP_SELF'],'home.php') != false ) ? "" : "" )
				echo '<ul class="nav nav-pills pull-right">';
					echo '<li ' . ( (strpos($_SERVER['PHP_SELF'],'home.php') != false ) ? 'class="active"' : '' ) . ' ><a href="home.php">Home</a></li>';
					echo '<li ' . ( (strpos($_SERVER['PHP_SELF'],'cards.php') != false ) ? 'class="active"' : '' ) . ' ><a href="cards.php">Cards</a></li>';
					echo '<li ' . ( (strpos($_SERVER['PHP_SELF'],'transactions.php') != false ) ? 'class="active"' : '' ) . ' ><a href="transactions.php">Transactions</a></li>';
					echo '<li><a href="logout.php" >Log out</a></li>';
				echo '</ul><h3 class="text-muted">Secure Payment Application<br/>Demonstration</h3>';

			echo '</div>';

		}else{
			echo <<<HTML
			<div class="header">
				<form class="navbar-form navbar-right" role="form" action="login.php" method="post" >
					<div class="form-group">
						<input type="text" placeholder="Email" name="email" class="form-control">
					</div>
					<div class="form-group">
						<input type="password" placeholder="Password" name="pass" class="form-control">
					</div>
					<button type="submit" class="btn btn-primary">Sign in</button>
				</form>
				<ul class="nav nav-pills pull-right">


				</ul>
HTML;


if( strpos($_SERVER['PHP_SELF'],'signup.php') != false ){
	echo '</ul><h3 class="text-muted">Secure Payment Application<br/>Demonstration</h3>';
}else{
	echo '<h3 class="text-muted"><br/><br/></h3>';
}


echo '</div>';

}


#return true;
}


function httpsAndSessionFix($mysqli){
	#Toggle HTTPS
	if( isset($_SERVER['HTTPS']) && !mitigateBool($mysqli, 'https') ){
	#redirect to standard
		$redirectTo = "http://" . $_SERVER['SERVER_NAME'] . "" . $_SERVER['REQUEST_URI'];
		header( 'Location: ' . $redirectTo ) ;
		die('<p>Redirecting to non HTTPS page. <a href="'.$redirectTo.'" >Click here.</a>');
	}elseif (!isset($_SERVER['HTTPS']) && mitigateBool($mysqli, 'https')) {
	# redirect to https!!!
		$redirectTo = "https://" . $_SERVER['SERVER_NAME'] . "" . $_SERVER['REQUEST_URI'];
		header( 'Location: ' . $redirectTo );
		die('<p>Redirecting to non HTTPS page. <a href="'.$redirectTo.'" >Click here.</a>');
	}

#Session fixation attack
	if(isset($_GET['SID'])){
		session_id ($_GET['SID']);
	}

#Start session!!!
	session_start();

#MAKE THIS A FUNCTION WHICH RETURNS TRUE OR FALSE, THE ERROR IF ANY OR USER ID!! TO BE USED THROUGHOUT THE PAGE


}






function outputFooter($loggedIn, $dashboard = true){
	echo "</div><!-- END OF 'container' DIV -->";

	if($dashboard){
		echo <<<HTML
			<!--
			<button class="btn btn-lg btn-success" id="dashboard_toggle" onclick="$('#dashboard_iframe').toggle();">Dashboard</button>
			<div id="dashboard" >
				<!--<iframe id="dashboard_iframe" src="../Dashboard/dash2.php" widht="300px" onLoad="document.getElementById(id).height= (document.getElementById('dashboard_iframe').contentWindow.document.body.scrollHeight) + 'px'" ></iframe>-->
				




				<div id="slide" style="right: -300px; top: 0px; width: 300px;">
					<div id="control">

						<iframe id="dashboard_iframe" seamless src="../Dashboard/dash5.php" widht="300px" height="100%" alllowtransparence="false" ></iframe>

						<button class="btn btn-lg btn-success" onclick="trythis();" id="dashboard_toggle" >Dashboard</button>

						<script type="text/javascript">
							function trythis(newTime) {
								var time = 500;
								if(newTime != null){
									time = newTime;
								}

								if( $.trim( $('#slide').css('right') ) != '0px'){ 
									$('#slide').animate({right:"0px"},time);
								//enable  
									$.get('../Dashboard/enable.php?enable[]=dashboard', function(data) {});
								}else{
									$('#slide').animate({right:"-300px"},time); 
																//disable
									$.get('../Dashboard/enable.php?disable[]=dashboard', function(data) {});
								}
							}
						</script>

					</div>
				</div>

HTML;
		}

		echo <<<HTML
		<div class="footer text-center">
			<p>Damien O'Sullivan's Final Year Project 2014</p>
		</div>
	</body>
	</html>
HTML;

#return true;
}


?>