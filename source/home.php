<?php
  require_once("database_functions.php");
  require_once("FYP_functions.php");

	session_start();  
  
  if(!isset($_SESSION['inThere']) || $_SESSION['inThere'] != 1) {
  		 header( 'Location: index.php?error=must_login' ) ;
  		
  }
  $userId = $_SESSION['userId'];
  
 ?>
			
<html>
	<head>
		<title>Hello</title>
	</head>
	<body>
	
		 <?php
		 	$dbconnection = connect_to_database( 'localhost', 'dos4', 'Password123', 'FYP' );
			
			$sql = "SELECT * FROM FYP.user_info WHERE userId = '" . $userId . "';";	
			//echo $sql;
			
			$dbresult = mysql_query($sql);
		 	
		 	if(mysql_num_rows($dbresult) != 1){
				 unset($_SESSION['inThere']);
				 header( 'Location: index.php?error=shit!' ) ;
			}else {
				$row = mysql_fetch_assoc($dbresult);
				echo "<h1>Home</h1>";
				$name = $row['fName'];
				echo "<h2>   Welcome, $name!</h2>";			
			}
		 ?>
			<h3>Store a card</h3>
			
			<form action="storeSecurly.php" action="get" >
				<div>
					<label for="card" >Card number:</label>
					<input type="text" name="card" id="card" />
				</div> 		
			
				<div>
					<label for="MM" >Expiry date (MM/YYYY):</label>
					<input type="text" name="MM" id="MM" size="4" />/
					<input type="text" name="YY" id="YY" size="4" />
				</div> 		
				
				<div>
					<label for="serv" >Service code:</label>
					<input type="text" name="serv" id="serv" />
				</div> 		
				
				<div>			
					
					<input type="submit" value="Add securely" />
				</div> 		
			</form>		
				
			
			
			<h3>View stored cards</h3>
			
			<?php
			
			$sql = "SELECT CONCAT( MONTH(expDate), '/', YEAR(expDate)) as expDate, serviceCode, truncatedCard FROM FYP.card_info WHERE user = '" . $userId . "';";	
			//echo $sql;
			$dbresult = mysql_query($sql);
			if(mysql_num_rows($dbresult) == 0){
				echo "<p>No cards stored :/ . Store some <em>securely</em>?</p>";
				
			}else{
				echo "<table><tr><th>Exp Date</th><th>Service Code</th><th>Card</th></tr>"	;			
				while($row = mysql_fetch_assoc($dbresult)){
						echo "<tr><td>".$row['expDate']."</td><td>".$row['serviceCode']."</td><td>".$row['truncatedCard']."</td></tr>";
					
					
				}	
				echo "</table>";
				
			}
			
			
			?>
			
		 	
		 	


	</body>
</html>