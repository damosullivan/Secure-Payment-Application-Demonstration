<?php

include_once(dirname(__FILE__) . "/include/config.php");
include_once(INCLUDE_DIR . "/" . "htmlFunctions.php");
include_once(INCLUDE_DIR . "/" . "mitigate.php");
include_once(INCLUDE_DIR . "/" . "FYP_functions.php");

session_start();

$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE );#Used till the end

$loggedIn = false;

outputHeader($loggedIn, $mysqli);

?>

<?php
  #mitigate("frameBlockingLegacy");
  #DONE AT  START OF BODY
?>


<?php

$fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_EMAIL);
$sname = filter_input(INPUT_POST, 'sname', FILTER_SANITIZE_EMAIL);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	  $pass = hashPass(filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING));#Straight into hash function
	  
	  $sqlFname = mitigate($mysqli, "realEscapeString", $fname);
	  $sqlSname = mitigate($mysqli, "realEscapeString", $sname);
	  $sqlEmail = mitigate($mysqli, "realEscapeString", $email);

	  /**
	  
	  **/

	  if ( mitigateBool($mysqli, 'preparedStatement') ) {
	  	$statement = $mysqli->prepare("SELECT email FROM user_info WHERE email = ? LIMIT 1");
	  	$statement->bind_param('s', $sqlEmail);
	  	$statement->execute();
	  	$statement->store_result();

	  	if ($statement->num_rows == 0){
	  		$statement = $mysqli->prepare("INSERT INTO user_info (fName, sName, email, passwordHash) VALUES (?,?,?,?);");
	  		$statement->bind_param('ssss', $sqlFname, $sqlSname, $sqlEmail, $pass);



	  		if ($statement->execute()) {
	  			#header("Location: home.php");
	  			echo "SUCCESS PREP";
	  		}else{
	  			header("Location: signup.php?error=error with info");
	  		}
		  	#redirect with email & pass

	  	}else{
	  		header("Location: signup.php?error=email address already registered");
	  	}


	  }else{
	  	$sql = "SELECT email FROM user_info WHERE email = '". $sqlEmail. "' LIMIT 1;";
	  	$result = $mysqli->query($sql);

	  	if ( $result->num_rows == 0 ) {
	  		$sql = "INSERT INTO `FYP`.`user_info` (`fName`, `sName`, `email`, `passwordHash`) VALUES ('" . $sqlFname . "', '" . $sqlSname . "', '". $sqlEmail . "', '". $pass. "');";
	  		if ( $result = $mysqli->query($sql) ) {
	  			#header("Location: home.php");
	  			echo "SUCCESS NOT PREP";
	  		}else{
	  			header("Location: signup.php?error=error with info");
	  		}
	  	}else{
	  		header("Location: signup.php?error=email address already registered");
	  	}

	  }





	  //extract data from the post
	  //extract($_POST);

//set POST variables
	  $url = 'http://localhost/FYP/OpenDay/login.php?SID=' + urlencode(session_id()) ;
	  $fields = array(
	  	'email' => urlencode($sqlEmail),
	  	'pass' => urlencode($_POST['pass']),
	  	);

//url-ify the data for the POST
	  $fields_string = "";
	  foreach($fields as $key=>$value) { 
	  	$fields_string .= $key.'='.$value.'&'; 
	  }
	  rtrim($fields_string, '&');
	  $fields_string = "email=" . $sqlEmail  . "&pass=" . $_POST['pass'];

//open connection
	  $ch = curl_init();

//set the url, number of POST vars, POST data
	  curl_setopt($ch,CURLOPT_URL, $url);
	  curl_setopt($ch,CURLOPT_POST, count($fields));
	  curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

//execute post
	  $result = curl_exec($ch);

//close connection
	  curl_close($ch);

	  echo session_id();



	  header("Location: home.php");
	  

//outputFooter($loggedIn);


	  /*
	  $sqlMitigate = array("regularSql" => "SELECT email FROM user_info WHERE email = '". $sqlEmail. "' LIMIT 1;",
	  	"prepareSql" => "SELECT email FROM user_info WHERE email = ? LIMIT 1",
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
	  */
	  ?>

	  <?php
	  outputFooter($loggedIn);
	  $mysqli->close();
	  ?>
