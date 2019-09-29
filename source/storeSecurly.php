<?php

  include_once(dirname(__FILE__) . "/include/config.php");
  include_once(INCLUDE_DIR . "/" . "htmlFunctions.php");
  include_once(INCLUDE_DIR . "/" . "mitigate.php");
  include_once(INCLUDE_DIR . "/" . "FYP_functions.php");

  session_start();

  $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE );#Used till the end

    
  #MAKE THIS A FUNCTION WHICH RETURNS TRUE OR FALSE, THE ERROR IF ANY OR USER ID!! TO BE USED THROUGHOUT THE PAGE
  if( !loggedIn($mysqli) ) {
    header( 'Location: logout.php' ) ;
   	die("Error: Not logged in.");
  }else{
  
  }

  $loggedIn = true;

 # outputHeader($loggedIn, $mysqli);

    
  $userId = $_SESSION['auth']['user_id'];

?>

<?php
	
	$card = filter_input(INPUT_POST, 'card', FILTER_SANITIZE_NUMBER_INT);
	  $MM  = filter_input(INPUT_POST, 'MM', FILTER_SANITIZE_NUMBER_INT);
	  $YY = filter_input(INPUT_POST, 'YY', FILTER_SANITIZE_NUMBER_INT);
	  $serv = filter_input(INPUT_POST, 'serv', FILTER_SANITIZE_NUMBER_INT);
	
	#$card = $_GET['card'];
	#$MM = $_GET['MM'];
	#$YY = $_GET['YY'];
	#$serv = $_GET['serv'];
	$key = "SecretKey1";

	$truncatedCard = truncateCard($card);
	
	$encryptedCard = fnEncrypt($card, $key);
	
	#$sql = "INSERT INTO `FYP`.`card_PAN` (`cardId`, `encryptedPAN`) VALUES (UUID(), '" . $encryptedCard . "');";

	$statement = $mysqli->prepare("INSERT INTO `FYP`.`card_PAN` (`cardId`, `encryptedPAN`) VALUES (UUID(), ? )");
	 			
	$statement->bind_param('s', $encryptedCard);
	$statement->execute();

	//DATE + MONTH
	//SELECT DAYOFMONTH('2001-11-00'), MONTH('2005-00-00');

	$dateTime = $YY."-".$MM."-1";

	#$sql = "SELECT cardId FROM card_PAN where encryptedPAN = '" . $encryptedCard . "';";
	$statement = $mysqli->prepare("SELECT cardId FROM card_PAN where encryptedPAN = ? ");

	$statement->bind_param('s', $encryptedCard);
	$statement->execute();

	$statement->bind_result($cardId);
	$statement->fetch();
	$statement->close();
				
	#$sql = "INSERT INTO `FYP`.`card_info` (`id`, `user`, `cardId`, `expDate`, `truncatedCard`) VALUES (UUID(), '" . $userId . "', '" . $cardId . "', '" . $dateTime . "', '" . $truncatedCard . "');";
	#$dbresult = mysql_query($sql);
	$statement = $mysqli->prepare("INSERT INTO `FYP`.`card_info` (`id`, `user`, `cardId`, `expDate`, `truncatedCard`) VALUES (UUID(), ? , ? , ? , ? )");

	$statement->bind_param('ssss', $userId, $cardId, $dateTime, $truncatedCard);
	$statement->execute();
	$statement->close();

	mitigate($mysqli, "regenerateSessionId");

	header( 'Location: cards.php' ) ;

?>