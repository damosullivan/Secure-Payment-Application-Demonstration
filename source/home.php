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


    
    
    echo "<h1>Home</h1>";
    $name = $_SESSION['auth']['fName'];
    echo "<h2>   Welcome, $name!</h2>";
    echo '<p><a href="logout.php" >Log out?</a></p>';
    
    
?>
    


<?php
    
    echo '<img src ="../Images/default.jpg" height="200px" />';
    
?>
    <form id="newPic" method="post" action="profilePic.php" enctype="multipart/form-data" >  
      <input type="file" name="file" id="file" /><!-- onchange="document.getElementById('newPic').submit();" -->
      <input type="submit" name="submit" value="Submit">
    </form>
      
    <h3>Store a card</h3>
			
			<form action="storeSecurly.php" method="post" >
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

			$statement = $mysqli->prepare("SELECT CONCAT( MONTH(expDate), '/', YEAR(expDate)) as expDate, serviceCode, truncatedCard, cardId FROM FYP.card_info WHERE user = ?");
      
			
			
			$statement->bind_param('s', $userId);
			$statement->execute();
			$statement->store_result();
			
			 if ($statement->num_rows > 0) {
			    
			    $statement->bind_result($expDate, $serviceCode, $truncatedCard, $cardId);
			    
			    echo "<table><tr><th>Exp Date</th><th>Service Code</th><th>Card</th></tr>";
			    
			    while($statement->fetch()){
				echo "<tr><td>".$expDate."</td><td>".$serviceCode."</td><td>".$truncatedCard."</td><td><a href=\"deleteCard.php?card_id=".$cardId."\" >Delete</a></td></tr>";
				#echo $returned_name . '<br />';
			    
			    
			    
			    }
			 
			    echo "</table>";
			
			 
			 }else{
			    echo "<p>No cards stored :/ . Store some <em>securely</em>?</p>";
			 }




  /*
?>


		 <?php
		 
			
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
			
		 	


<?php
*/
  outputFooter($loggedIn);
  $mysqli->close();
?>