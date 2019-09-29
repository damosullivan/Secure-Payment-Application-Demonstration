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
	die("Error: Not logged in");
}else{
	$loggedIn = true;
}

#outputHeader($loggedIn, $mysqli);

$userId = $_SESSION['auth']['user_id'];


$payee = $_GET['email']; #must get their id
$amount = $_GET['amount'];
$comment = $_GET['comment'];
$CSRFToken = "NO CSRFToken";
if (isset($_GET['CSRFToken'])) {
	$CSRFToken = $_GET['CSRFToken'];
}





$expect = hash('sha512', $_SESSION['auth']['login_string'] . (ceil(time() / 100) * 100));
$olderExpect = hash('sha512', $_SESSION['auth']['login_string'] . (ceil ((time() / 100) -1 ) * 100));


if( !mitigateBool($mysqli, 'CSRFToken') || (  $CSRFToken == $expect || $CSRFToken == $olderExpect  )){

	$payeeId = "No";


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
			header("Location: transactions.php?error=Invalid email address");
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
			header("Location: transactions.php?error=Invalid email address");
			echo "Invalid email address yoyo";
			die();
		}

	}






#INSERT TRANSACTION!!!!

# INSERT INTO transactions (`date_time`, `to_Id`, `from_Id`, `amount`, `comment`) VALUES ( now(), '27', '4', '35.70', 'comments');


	if(mitigateBool($mysqli, "preparedStatement")){
  	//echo "<p>Using prepared statement</p>";
		$statement = $mysqli->prepare("INSERT INTO transactions (`date_time`, `to_Id`, `from_Id`, `amount`, `comment`) VALUES ( now(), ?, ?, ?, ?)");
		$statement->bind_param('ssds', $payeeId, $userId, $amount, $comment);





		if ($statement->execute()) {
			header("Location: transactions.php");
			echo "success";

		}else{
			header("Location: transactions.php?error=insert error");
			echo "Error insetring, in statement";
			die();
		}

	}else{
  	//echo "<p>Not using prepared statement</p>";
		$sql = "INSERT INTO transactions (`date_time`, `to_Id`, `from_Id`, `amount`, `comment`) VALUES ( now(), '".$payeeId."', '".$userId."', '".$amount."', '".$comment."');";



		if ($result = $mysqli->query($sql)) {
			header("Location: transactions.php");
			echo "success";

		}else{
			header("Location: transactions.php?error=insert error");
			echo "Error insetring, in non prep statement";
			die();
		}

	}

}else{
	header("Location: transactions.php");
}








?>


