<?php
  require_once("database_functions.php");
  require_once("FYP_functions.php");
  $mysqli = new mysqli( 'localhost', 'dos4', 'Password123', 'FYP' );

    $cleanemail = $_GET['email'];
    $pass = $_GET['pass'];
    if(true){
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
    }else{
    
    
    
      $dbconnection = connect_to_database( 'localhost', 'dos4', 'Password123', 'FYP' );
      
      $sql = "SELECT userId, email, passwordHash FROM FYP.user_info WHERE email = '" . $cleanemail . "';";
      
      
      $dbresult = mysql_query($sql);
      
      if(mysql_num_rows($dbresult) != 1){
		header( 'Location: index.php?error=username_wrong' ) ;
      }else {
	      $row = mysql_fetch_assoc($dbresult);
	      $email = $row['email'];
	      $storedPass = $row['passwordHash'];
				      
	      
	      if( comaprePassword($storedPass, $pass) ){
		      session_start();
		      $_SESSION['inThere'] = 1;
		      $_SESSION['userId'] = $row['userId'];
		      header( 'Location: home.php' ) ;

	      }else{
			header( 'Location: index.php?error=password_wrong' ) ;
	      }
	      
	      
	      
      }

    }
$mysqli->close();
?>
