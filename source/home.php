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

$name = $_SESSION['auth']['fName'];
echo "<h2>Welcome, $name</h2>";

?>


<div id="profile_pic" >
	
</div>

<div class="row">
	<div class="col-md-4">
		<h3>Information</h3>
		<table class="table" >
			<tr>
				<th>Name</th>
				<td><?php echo stripslashes($name . " " . $_SESSION['auth']['sName']); ?></td>
			</tr>
			<tr>
				<th>Email</th>
				<td><?php echo $_SESSION['auth']['email']; ?></td>
			</tr>
			
					<?php
					$balance = 0;
					$transactions = 0;
					$cards = 0;
					if(mitigateBool($mysqli, 'preparedStatement')){
							#prep state




					}else{
							#not prep statement
						$sql = "SELECT sum(debt.sum + cred.sum) as balance, transactions, cards FROM (
-- SELECT *  FROM (

	(SELECT from_id, -sum(amount) as sum FROM FYP.transactions WHERE from_id = " . $userId . ") as debt
	LEFT JOIN (SELECT to_id, sum(amount) as sum FROM FYP.transactions WHERE to_id = " . $userId . ") as cred
	ON debt.from_id = cred.to_id

	)

LEFT JOIN 
	(SELECT from_id as user_id, COUNT(*) as transactions from transactions where to_id = " . $userId . " or from_Id = " . $userId . ") as trans
ON trans.user_id = debt.from_id

LEFT JOIN 
	(SELECT user, count(*) as cards FROM FYP.card_info GROUP BY user ) as cards
on debt.from_id = cards.user;
";



						if ($result = $mysqli->query($sql)) {
							$row = $result->fetch_assoc();
							$balance = $row['balance'];
							$transactions = $row['transactions'];
							$cards = $row['cards'];
						}
					}
					$balance = sprintf('%0.2f', $balance);
					
					?>
					<tr>
						<th>Cards</th>
						<td><a href="cards.php" ><?php echo ($cards == "" ? 0 : $cards); ?></a></td>
					</tr>
					<tr>
						<th>Transactions</th>
						<td><a href="transactions.php#transactions" ><?php echo ($transactions == "" ? 0 : $transactions); ?></td>
					</tr>
					<tr>
						<th>Balance</th>
						<td>&euro;<?php echo ($balance == "" ? 0 : $balance); ?></td>
				<!-- 
		SELECT sum(debt.sum + cred.sum) FROM (

		(SELECT idtransactions, from_id, -sum(amount) as sum FROM FYP.transactions WHERE from_id = 27) as debt
		LEFT JOIN (SELECT idtransactions, to_id, sum(amount) as sum FROM FYP.transactions WHERE to_id = 27) as cred
		ON debt.from_id = cred.to_id

		) 
	-->
</tr>
</table>

</div>
<div class="col-md-4"></div>
<div class="col-md-4">
	<?php
	echo '<img src ="../Images/'.$_SESSION['auth']['imgUrl'].'" class="img-thumbnail" />';
	?>

	<form id="newPic" method="post" action="profilePic.php" enctype="multipart/form-data" >  
		<input type="file" class="form-control" name="file" id="file" /><!-- onchange="document.getElementById('newPic').submit();" -->
		<input type="text" class="form-control" name="file_name" value="profile.jpg" id="file_name" /><!-- onchange="document.getElementById('newPic').submit();" -->
		<button class="btn btn-primary btn-block" type="submit">Upload..</button>
	</form>
</div>
</div>


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
			<input class="btn btn-default" type="submit" value="Pay" />
		</form>

	</div>


	<div class="col-md-8"></div>

</div>

<?php

outputFooter($loggedIn);
$mysqli->close();
?>