<?php

include_once(dirname(__FILE__) . "/../include/config.php");
include_once(INCLUDE_DIR . "/" . "htmlFunctions.php");
include_once(INCLUDE_DIR . "/" . "mitigate.php");
include_once(INCLUDE_DIR . "/" . "FYP_functions.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Session Fixation Atack</title>
	<link type="text/css" href="style.css" rel="stylesheet" />
</head>
<body>
	<div id="wrapper" >
		<h1>Session Fixation Atack</h1>

		<h2>Malicious</h2>

		<p>
			Here we can send the user a link and request them to log into the website. The user will be happy to do so, as there is nothing suspecious about that.
			However, we can fix their session to any session id we like. If we both are using the same session id, we are both using the same session, and therefore when they
			log in I now will have access to their active session. ie. I will be logged in as them.
		</p>

		<p>We will get them to log in using this url, with the id set to 'use_this_session_id'.</p>

		<p><a href="https://localhost/FYP/OpenDay/index.php?SID=123456789">http://localhost/FYP/OpenDay/index.php?SID=123456789</a></p>

		<p>We will also load up this url on out browser, and wait.</p>

		<h2>How to defend</h2>

		<p>There is a frame blocking meta tag option to disable external sites framing the web app</p>

		<p>
		<pre><?php echo htmlentities('<meta http-equiv="X-FRAME-OPTIONS" content="DENY">'); ?></pre>
		</p>


	</div>
</body>
</html>
