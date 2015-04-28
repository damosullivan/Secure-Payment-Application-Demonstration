<?php
  require_once("database_functions.php");
  require_once("FYP_functions.php");

	session_start();  
  
  if(!isset($_SESSION['inThere']) || $_SESSION['inThere'] != 1) {
  		 header( 'Location: index.php?error=must_login' ) ;
  		
  }
  $userId = $_SESSION['userId'];
  
 ?>



<?php
	$dbconnection = connect_to_database( 'localhost', 'dos4', 'Password123', 'FYP' );
	$card = $_GET['card'];
	$MM = $_GET['MM'];
	$YY = $_GET['YY'];
	$serv = $_GET['serv'];
	$key = "SecretKey1";

	$truncatedCard = truncateCard($card);
	
	$encryptedCard = fnEncrypt($card, $key);
	
	
	
	
	
	
	
$sql = "INSERT INTO `FYP`.`card_PAN` (`cardId`, `encryptedPAN`) VALUES (UUID(), '" . $encryptedCard . "');";
$dbresult = mysql_query($sql);


//DATE + MONTH
//SELECT DAYOFMONTH('2001-11-00'), MONTH('2005-00-00');

$dateTime = $YY."-".$MM."-1";





$sql = "SELECT cardId FROM card_PAN where encryptedPAN = '" . $encryptedCard . "';";
echo $sql;
$dbresult = mysql_query($sql);


	if(mysql_num_rows($dbresult) != 1){
				 echo "ERROR";
			}else {
				$row = mysql_fetch_assoc($dbresult);
				
				$cardId = $row['cardId'];
		
									
				$sql = "INSERT INTO `FYP`.`card_info` (`id`, `user`, `cardId`, `expDate`, `truncatedCard`) VALUES (UUID(), '" . $userId . "', '" . $cardId . "', '" . $dateTime . "', '" . $truncatedCard . "');";
				$dbresult = mysql_query($sql);

				echo "SUCCESS!!!";
				
				
						
			}



	

?>