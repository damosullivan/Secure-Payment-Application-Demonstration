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

<!--		
echo mitigate('frameBlock');
DONE IN HEAD!!!!!!
-->	

<?php
  #mitigate("frameBlockingLegacy");
  #DONE AT  START OF BODY
?>

	<h1>Processing...</h1>
	
	<?php
	  
	  $fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_EMAIL);
	  $sname = filter_input(INPUT_POST, 'sname', FILTER_SANITIZE_EMAIL);
	  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	  $pass = hashPass(filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING));#Straight into hash function
	  
	  $sqlFname = mitigate($mysqli, "realEscapeString", $fname);
	  $sqlSname = mitigate($mysqli, "realEscapeString", $sname);
	  $sqlEmail = mitigate($mysqli, "realEscapeString", $email);
	 
	  /**
	  $statement = $mysqli->prepare("SELECT email FROM FYP.user_info WHERE email = ? LIMIT 1");
	  $statement->bind_param('s', $sqlEmail);
	  $statement->execute();
	  $statement->store_result();
	  **/
	  
	  $sqlMitigate = array("regularSql" => "SELECT email FROM FYP.user_info WHERE email = '". $sqlEmail. "' LIMIT 1;",
				"prepareSql" => "SELECT email FROM FYP.user_info WHERE email = ? LIMIT 1",
				"prepareTypes" => "s",
				"prepareParam" => array(&$sqlEmail)#must be refferences, not values
				);

	  $statement = mitigate($mysqli, "preparedStatement", $sqlMitigate);
	  
	  echo "Num of rows = ".$statement->num_rows;
	  die();
	  
	  
	  
	  if ($statement->num_rows == 0) {
	  
	    $sqlMitigate = array("regularSql" => "INSERT INTO `FYP`.`user_info` (`fName`, `sName`, `email`, `passwordHash`) VALUES ('" . $sqlFname . "', '" . $sqlSname . "', '". $sqlEmail . "', '". $pass. "');",
					 "prepareSql" => "INSERT INTO user_info (fName, sName, email, passwordHash) VALUES (?,?,?,?);",
					 "prepareTypes" => "ssss",
					 "prepareParam" => array(&$sqlFname, &$sqlSname, &$sqlEmail, &$pass)#must be refferences, not values
					 );

	    mitigate($mysqli, "preparedStatement", $sqlMitigate);
	  
	  
	  
	  
	  
	  
	  }else{
	    //email address already registered
	  }
	
	?>

<?php
  outputFooter($loggedIn);
  $mysqli->close();
?>
