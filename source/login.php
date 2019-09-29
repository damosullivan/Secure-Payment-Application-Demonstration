<?php

include_once(dirname(__FILE__) . "/include/config.php");
include_once(INCLUDE_DIR . "/" . "htmlFunctions.php");
include_once(INCLUDE_DIR . "/" . "mitigate.php");
include_once(INCLUDE_DIR . "/" . "FYP_functions.php");

$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE );#Used till the end

$loggedIn = false;

httpsAndSessionFix($mysqli);

#not needed??
outputHeader($loggedIn, $mysqli);

?>

<?php
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
  #$pass = hashPass($pass); // cant do here as I do not have the salt or iterator yet


#GET RID OF ME!
$email = $_POST['email'];




$cleanEmail = mitigate($mysqli, 'realEscapeString', $email);





//$query = $mysqli->query($sql);

if(mitigateBool($mysqli, "preparedStatement")){
//if(false){
	$statement = $mysqli->prepare("SELECT userId, fName, sName, passwordHash, image FROM FYP.user_info WHERE email = ? LIMIT 1");
	$statement->bind_param('s', $cleanEmail);
	$statement->execute();
	$statement->store_result();

	if ($statement->num_rows == 1) {
		$statement->bind_result($user_id, $fName, $sName, $storedPass, $image);
		$statement->fetch();

		list($salt, $iterator, $storedHashedPassword) = explode(":", $storedPass);


		if($storedPass == hashPass($pass, $salt, $iterator) ){
			echo "Logged in";

			$user_browser = $_SERVER['HTTP_USER_AGENT'];
			$_SESSION['auth']['user_id'] = $user_id;
	      // XSS protection as we might print this value
			$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $fName);
			$_SESSION['auth']['fName'] = $fName;
			$_SESSION['auth']['sName'] = $sName;
			$_SESSION['auth']['email'] = $cleanEmail;


			$_SESSION['auth']['imgUrl'] = $image;

	      $user_browser = $_SERVER['HTTP_USER_AGENT'];#can be checked evertime
	      $_SESSION['auth']['login_string'] = hash('sha512', $storedPass . $user_browser);#may not use!!
	      
	      //session_regenerate_id(TRUE);
	      mitigate($mysqli, "regenerateSessionId");

	     /*
	      echo "<ul>";
	      echo "<li>".$_SESSION['auth']['user_id']."</li>";
	      echo "<li>".$_SESSION['auth']['fName']."</li>";
	      echo "<li>".$_SESSION['auth']['login_string']."</li>";
	      echo "</ul>";
	     */ 

	      header( 'Location: home.php' ) ;
	      
	  }else{
	      //wrong password
	  	echo "wrong password";
	  	header( 'Location: index.php?error=wrong password 1' ) ;
	  }

	}else{
	    //Invalid Email Address
		echo "Wrong email";
		header( 'Location: index.php?error=wrong email' ) ;
	}
}else{#not prepared statements!!!
	$sql = "SELECT userId, fName, sName, passwordHash, image FROM FYP.user_info WHERE email = '" . $cleanEmail . "' LIMIT 1";

	$result = $mysqli->query($sql);

	if ($result->num_rows > 0) {
		$firstRow = $result->fetch_assoc();

		#var_dump($firstRow);
		#die();

		$user_id = $firstRow['userId'];
		$fName = $firstRow['fName'];
		$sName = $firstRow['sName'];
		$storedPass = $firstRow['passwordHash'];
		$image = $firstRow['image'];

		list($salt, $iterator, $storedHashedPassword) = explode(":", $storedPass);
		if($storedPass == hashPass($pass, $salt, $iterator) ){
			echo "Logged in";

			$user_browser = $_SERVER['HTTP_USER_AGENT'];
			$_SESSION['auth']['user_id'] = $user_id;
	      // XSS protection as we might print this value
			$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $fName);
			$_SESSION['auth']['fName'] = $fName;
			$_SESSION['auth']['sName'] = $sName;
			$_SESSION['auth']['email'] = $cleanEmail;


			$_SESSION['auth']['imgUrl'] = $image;

	      $user_browser = $_SERVER['HTTP_USER_AGENT'];#can be checked evertime
	      $_SESSION['auth']['login_string'] = hash('sha512', $storedPass . $user_browser);#may not use!!
	      
	      //session_regenerate_id(TRUE);
	      mitigate($mysqli, "regenerateSessionId");

	     /*
	      echo "<ul>";
	      echo "<li>".$_SESSION['auth']['user_id']."</li>";
	      echo "<li>".$_SESSION['auth']['fName']."</li>";
	      echo "<li>".$_SESSION['auth']['login_string']."</li>";
	      echo "</ul>";
	     */ 

	      header( 'Location: home.php' ) ;

	  }else{
	      //wrong password
	  	echo "wrong password";
	  	header( 'Location: index.php?error=wrong password' ) ;
	  }

	}else{
	    //Invalid Email Address
		echo "Wrong email";
		header( 'Location: index.php?error=wrong email' ) ;
	}
}
      
      ?>    
      <?php
      outputFooter($loggedIn);
      $mysqli->close();
      ?>
