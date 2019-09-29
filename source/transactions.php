<?php

include_once(dirname(__FILE__) . "/include/config.php");
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


<div class="row">
<div class="col-md-4">
<h3>Pay Someone</h3>
<p>You can transfer funds to someone via email.</p>
<form class=".form-control" action="payment.php" method="get" role="form" >
	<div class="form-group" >
		<label for="transfer_email" >Email address: </label>
		<input type="text" class="form-control" name="email" id="transfer_email" />
	</div>
	<div class="form-group" >
		<label for="transfer_amount" >Amount (&euro;): </label>
		<input type="text" class="form-control" name="amount" id="transfer_amount" />
	</div>
	<div class="form-group" >
		<label for="transfer_comment" >Description: </label>
		<textarea name="comment" class="form-control" id="transfer_comment" rows="3" ></textarea>
	</div>

	<input type="hidden" name="CSRFToken" value="<?php echo hash('sha512', $_SESSION['auth']['login_string'] . (ceil(time() / 100) * 100)); ?>" />
	

	<input class="btn btn-default" type="submit" value="Pay" />
</form>

</div>


  <div class="col-md-8"></div>
  
</div>

<div class="row">
<div class="col-md-12">
<?php
echo "<h3 id=\"transactions\" >Transactions</h3>";

if(mitigateBool($mysqli, "preparedStatement")){
  	//echo "<p>Using prepared statement</p>";
	$statement = $mysqli->prepare("SELECT date_time, toTable.email as to_Id, fromTable.email as from_Id, amount, comment FROM FYP.transactions
left join (SELECT userId, email FROM user_info) as toTable on to_Id = toTable.userId
left join (SELECT userId, email FROM user_info) as fromTable on from_Id = fromTable.userId
WHERE transactions.to_Id = ? OR transactions.from_Id = ?");
	$statement->bind_param('ss', $userId, $userId);
	$statement->execute();
	$statement->store_result();



	if ($statement->num_rows > 0) {
		$statement->bind_result($date_time, $to_Id, $from_Id, $amount, $comment);
	
		echo "<table class=\"table table-bordered\" ><tr><th>Date</th><th>To</th><th>From</th><th>Comment</th><th>Amount (&euro;)</th><th>Balance</th></tr>";
		
		$balance = 0;

		while($statement->fetch()){
			echo "<tr><td>".$date_time."</td><td>".$to_Id."</td><td>".$from_Id."</td>
			<td>".$comment."</td><td>".(sprintf('%0.2f', $amount))."</td>";

			if ($_SESSION['auth']['email'] == $to_Id) {
				
				$balance += $amount;

			}else{
				$balance -= $amount;
			}

			$balance = sprintf('%0.2f', $balance);

			echo "<td>&euro;".( ($balance >= 0)?($balance):"{$balance}")."</td>";


			echo "</tr>";	
		}
		echo "<tr><td></td><td></td><td></td><td></td><td>Current balance:</td><td>&euro;{$balance}</td></tr>";
		echo "</table>";
	}else{
		echo "<p>No recent transactions.</p>";
	}

}else{
  	//echo "<p>Not using prepared statement</p>";
	$sql = "SELECT date_time, toTable.email as to_Id, fromTable.email as from_Id, amount, comment FROM FYP.transactions
left join (SELECT userId, email FROM user_info) as toTable on to_Id = toTable.userId
left join (SELECT userId, email FROM user_info) as fromTable on from_Id = fromTable.userId
WHERE transactions.to_Id = ".$userId." OR transactions.from_Id = ".$userId.";";
	#$result = $mysqli->query($sql);

	$balance = 0;

	if ($result = $mysqli->query($sql)) {

		echo "<table class=\"table table-bordered\" ><tr><th>Date</th><th>To</th><th>From</th><th>Comment</th><th>Amount (&euro;)</th><th>Balance</th></tr>";
		while($row = $result->fetch_assoc()){
			echo "<tr><td>".$row['date_time']."</td><td>".$row['to_Id']."</td><td>".$row['from_Id']."</td>
			<td>".$row['comment']."</td><td>".(sprintf('%0.2f', $row['amount']))."</td>";

			if ($_SESSION['auth']['email'] == $row['to_Id']) {
				$balance += $row['amount'];

			}else{
				$balance -= $row['amount'];
			}

			$balance = sprintf('%0.2f', $balance);

			echo "<td>&euro;".( ($balance >= 0)?($balance):"{$balance}")."</td>";


			echo "</tr>";	
		}
		echo "<tr><td></td><td></td><td></td><td></td><td>Current balance:</td><td>&euro;{$balance}</td></tr>";
		echo "</table>";
	}else{
		echo "<p>No recent transactions.</p>";
	}
}
echo  "</div>";
echo  "</div>";

outputFooter($loggedIn);
$mysqli->close();
?>