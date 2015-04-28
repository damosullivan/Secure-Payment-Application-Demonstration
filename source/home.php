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
				<td>Damien  O'Sullivan</td>
			</tr>
			<tr>
				<th>Email</th>
				<td>damosullivan@gmail.com</td>
			</tr>
			<tr>
				<th>Cards</th>
				<td>2</td>
			</tr>
			<tr>
				<th>Transactions</th>
				<td>10</td>
			</tr>
			<tr>
				<th>Balance</th>
				<td>&euro;123</td>
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
			<input type="text" class="form-control" name="file_name" placeholder="File name" id="file_name" /><!-- onchange="document.getElementById('newPic').submit();" -->
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