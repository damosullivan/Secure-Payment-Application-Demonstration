<?php

include_once("../include/config.php");
include_once(INCLUDE_DIR . "/" . "htmlFunctions.php");
include_once(INCLUDE_DIR . "/" . "mitigate.php");
include_once(INCLUDE_DIR . "/" . "FYP_functions.php");

$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE );#Used till the end

httpsAndSessionFix($mysqli);

$loggedIn = false;
if( !loggedIn($mysqli) ) {
	header( 'Location: logout.php' ) ;
	die("Error: Not logged in");
}else{
	$loggedIn = true;
}

outputHeader($loggedIn, $mysqli);

$userId = $_SESSION['auth']['user_id'];

?>


<div class="row marketing">
	<div class="col-lg-4">
	<h3>Add Card</h3>

		<form action="storeSecurly.php" method="post" class="form-horizontal" role="form" >
			<div class="form-group" >
				<label for="card" >Card number:</label>
				<input type="text" class="form-control" name="card" id="card" />
			</div> 		

			<div class="form-group" >
				<label for="MM" >Expiry date (MM/YYYY):</label>
				<input type="text" class="form-control" name="MM" id="MM" size="4" />/
				<input type="text" class="form-control" name="YY" id="YY" size="4" />
			</div> 		

			<div class="form-group" >
				<label for="serv" >Service code:</label>
				<input type="text" class="form-control" name="serv" id="serv" />
			</div> 		

			<div class="form-group" >			

				<button class="btn btn-lg btn-primary btn-block" type="submit">Store securly</button>
			</div> 		
		</form>	
	</div>




	<div class="col-lg-8">
		<h3>Stored Cards</h3>

		<?php

		if(mitigateBool($mysqli, "preparedStatement")){
  	//echo "<p>Using prepared statement</p>";
			$statement = $mysqli->prepare("SELECT CONCAT( MONTH(expDate), '/', YEAR(expDate)) as expDate, serviceCode, truncatedCard, cardId FROM FYP.card_info WHERE user = ?");
			$statement->bind_param('s', $userId);
			$statement->execute();
			$statement->store_result();

			if ($statement->num_rows > 0) {
				$statement->bind_result($expDate, $serviceCode, $truncatedCard, $cardId);
				echo "<table class=\"table\" ><tr><th>Exp Date</th><th>Service Code</th><th>Card</th></tr>";
				while($statement->fetch()){
					echo "<tr><td>".$expDate."</td><td>".$serviceCode."</td><td>".$truncatedCard."</td><td><a href=\"deleteCard.php?card_id=".$cardId."\" >Delete</a></td></tr>";
				}
				echo "</table>";
			}else{
				echo "<p>No cards stored :/ . Store some <em>securely</em>?</p>";
			}

		}else{
  	//echo "<p>Not using prepared statement</p>";
			$sql = "SELECT CONCAT( MONTH(expDate), '/', YEAR(expDate)) as expDate, serviceCode, truncatedCard, cardId FROM FYP.card_info WHERE user = '".$userId."'";
			$result = $mysqli->query($sql);


			if ($result->num_rows > 0) {

				echo "<table class=\"table\" ><tr><th>Exp Date</th><th>Service Code</th><th>Card</th></tr>";
				while($row = $result->fetch_assoc()){
					echo "<tr><td>".$row['expDate']."</td><td>".$row['serviceCode']."</td><td>".$row['truncatedCard']."</td><td><a href=\"deleteCard.php?card_id=".$row['cardId']."\" >Delete</a></td></tr>";
				}
				echo "</table>";
			}else{
				echo "<p>No cards stored :/ . Store some <em>securely</em>?</p>";
			}
		}

		?>

	</div>
</div>

	<?php
	outputFooter($loggedIn);
	$mysqli->close();
	?>