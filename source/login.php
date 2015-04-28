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


<?php
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
  #$pass = hashPass($pass); // cant do here as I do not have the salt or iterator yet
  

  
  $cleanEmail = mitigate($mysqli, 'realEscapeString', $email);
  
  $statement = $mysqli->prepare("SELECT userId, fName, passwordHash FROM FYP.user_info WHERE email = ? LIMIT 1");
  $statement->bind_param('s', $cleanEmail);
  $statement->execute();
  $statement->store_result();
  
  if ($statement->num_rows == 1) {
    $statement->bind_result($user_id, $fName, $storedPass);
    $statement->fetch();
    
    list($salt, $iterator, $storedHashedPassword) = explode(":", $storedPass);
    
    if($storedPass == hashPass($pass, $salt, $iterator) ){
      echo "Logged in";
      
      $user_browser = $_SERVER['HTTP_USER_AGENT'];
      $_SESSION['user_id'] = $user_id;
      // XSS protection as we might print this value
      $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $fName);
      $_SESSION['fName'] = $fName;
      
      $user_browser = $_SERVER['HTTP_USER_AGENT'];#can be checked evertime
      $_SESSION['login_string'] = hash('sha512', $storedPass . $user_browser);#may not use!!
      
      session_regenerate_id(TRUE);
      
      echo "<ul>";
      echo "<li>".$_SESSION['user_id']."</li>";
      echo "<li>".$_SESSION['fName']."</li>";
      echo "<li>".$_SESSION['login_string']."</li>";
      echo "</ul>";
      
      
      
      
      
      
      
      
      
      
    }else{
      //wrong password
      echo "wrong password";
    }
    
    
    
    
    
    
    
  }else{
    //Invalid Email Address
    echo "Wrong email";
  }

  
  

/**
      $filter_email = filter_var( $_GET['email'], FILTER_VALIDATE_EMAIL );				
      $cleanemail = $mysqli->real_escape_string($filter_email);
      #$cleanemail = $filter_email;
      
      
      $statement = $mysqli->prepare("SELECT userId, email, passwordHash FROM FYP.user_info WHERE email = ?");
      $statement->bind_param('s', $cleanemail);
      $statement->execute();
      $statement->bind_result($storedUserId, $storedemail, $storedPass);
      if($statement->fetch()){
	if( comaprePassword($storedPass, $pass) ){
	  session_start();
	  $_SESSION['inThere'] = 1;
	  $_SESSION['userId'] = $storedUserId;
	  header( 'Location: home.php' ) ;

	 }else{
	  header( 'Location: index.php?error=password_wrong' ) ;
	 }
	 
      }
      $statement->close();

*/	      
?>    
<?php
  outputFooter($loggedIn);
  $mysqli->close();
?>