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
	die("Error: Not logged in");
}else{
	$loggedIn = true;
}

outputHeader($loggedIn, $mysqli);

$userId = $_SESSION['auth']['user_id'];


$payee = $_GET['email']; #must get their id
$amount = $_GET['amount'];
$comment = $_GET['comment'];

$payeeId = "No";



#get payee id!!!
echo "<h3>Transactions</h3>";


if(mitigateBool($mysqli, "preparedStatement")){
  	//echo "<p>Using prepared statement</p>";
	$statement = $mysqli->prepare("SELECT userId FROM FYP.user_info WHERE email = ? AND userId != ?");
	$statement->bind_param('ss', $payee, $userId);
	$statement->execute();
	$statement->store_result();



	if ($statement->num_rows > 0) {
		$statement->bind_result($tempId);
		$statement->fetch();

		$payeeId = $tempId;

	}else{
		echo "Invalid email address yoyo";
		die();
	}

}else{
  	//echo "<p>Not using prepared statement</p>";
	$sql = "SELECT userId FROM FYP.user_info WHERE email = '".$payee."' AND userId != '".$userId."';";
	
	$result = $mysqli->query($sql);

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$payeeId = $row['userId'];

		#echo $payeeId;


		
	}else{
		echo "Invalid email address yoyo";
		die();
	}

}

echo $payeeId;



#INSERT TRANSACTION!!!!

# INSERT INTO transactions (`date_time`, `to_Id`, `from_Id`, `amount`, `comment`) VALUES ( now(), '27', '4', '35.70', 'comments');


if(mitigateBool($mysqli, "preparedStatement")){
  	//echo "<p>Using prepared statement</p>";
	$statement = $mysqli->prepare("INSERT INTO transactions (`date_time`, `to_Id`, `from_Id`, `amount`, `comment`) VALUES ( now(), ?, ?, ?, ?)");
	$statement->bind_param('ssds', $payeeId, $userId, $amount, $comment);
	
	



	if ($statement->execute()) {
		echo "success";

	}else{
		echo "Error insetring, in statement";
		die();
	}

}else{
  	//echo "<p>Not using prepared statement</p>";
	$sql = "INSERT INTO transactions (`date_time`, `to_Id`, `from_Id`, `amount`, `comment`) VALUES ( now(), '".$payeeId."', '".$userId."', '".$amount."', '".$comment."');";
	
	

	if ($result = $mysqli->query($sql)) {
		echo "success";
		
	}else{
		echo "Error insetring, in non prep statement";
		die();
	}

}










?>


