<?php
  include_once("../include/config.php");
  include_once(INCLUDE_DIR . "/" . "htmlFunctions.php");
  include_once(INCLUDE_DIR . "/" . "mitigate.php");
  include_once(INCLUDE_DIR . "/" . "FYP_functions.php");

  session_start();

  $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE );#Used till the end

    
  #MAKE THIS A FUNCTION WHICH RETURNS TRUE OR FALSE, THE ERROR IF ANY OR USER ID!! TO BE USED THROUGHOUT THE PAGE
  if( !loggedIn($mysqli) ) {
    header( 'Location: logout.php' ) ;
   
  }else{
  
  }

  $loggedIn = false;

  outputHeader($loggedIn, $mysqli);

    
  $userId = $_SESSION['auth']['user_id'];

  $card_id = $_GET['card_id'];
  
  #if user owns card with id,
  
  #$_SESSION['auth']['user_id']
   #$card_id 
   
   #SELECT * FROM FYP.card_info, user_info  WHERE user = userId AND userId = 6 AND cardId = '3e267e84-5b55-11e3-b353-0025644e5873';
   $statement = $mysqli->prepare("SELECT * FROM FYP.card_info, user_info  WHERE user = userId AND userId = ? AND cardId = ? ");
  $statement->bind_param('ss', $_SESSION['auth']['user_id'], $card_id );
  $statement->execute();
  $statement->store_result();
  
  if ($statement->num_rows == 1) {
    #owns card
    #echo "OK";
    
     #delete from card_info, and card_PAN
     
     $statement = $mysqli->prepare("DELETE FROM `FYP`.`card_PAN` WHERE `cardId`= ? ");
      $statement->bind_param('s', $card_id );
      $statement->execute();
      $statement->store_result();
      
      #LOOK UP MULTI QUERY STUFF!!!!!!!!!!!!!!!!
      
       $statement = $mysqli->prepare("DELETE FROM `FYP`.`card_info` WHERE `cardId`= ? ");
      $statement->bind_param('s', $card_id );
      $statement->execute();
      $statement->store_result();
      
      #echo "Deleted";
     
     header( 'Location: home.php' ) ;
  
  
  
  }
  
 
    
    
 header( 'Location: home.php' ) ;









?>