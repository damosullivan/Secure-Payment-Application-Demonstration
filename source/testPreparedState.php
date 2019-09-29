 <?php 
 include_once(dirname(__FILE__) . "/include/config.php");
 include_once(INCLUDE_DIR . "/" . "htmlFunctions.php");
 include_once(INCLUDE_DIR . "/" . "mitigate.php");
 include_once(INCLUDE_DIR . "/" . "FYP_functions.php");

 session_start();

  $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE );#Used till the end

  #MYSQLI PREP
  $statement = $mysqli->prepare("SELECT CONCAT( MONTH(expDate), '/', YEAR(expDate)) as expDate, serviceCode, truncatedCard, cardId FROM FYP.card_info WHERE user = ?");
  $num = 6;
  $statement->bind_param('s', $num);
  $statement->execute();
  $statement->store_result();
  if ($statement->num_rows > 0) {
  	$statement->bind_result($expDate, $serviceCode, $truncatedCard, $cardId);
  	echo "<table><tr><th>Exp Date</th><th>Service Code</th><th>Card</th></tr>";
  	while($statement->fetch()){
  		echo "<tr><td>".$expDate."</td><td>".$serviceCode."</td><td>".$truncatedCard."</td><td><a href=\"deleteCard.php?card_id=".$cardId."\" >Delete</a></td></tr>";

  	}
  	echo "</table>";
  }

  #MYSQL QUERY
  $sql = "SELECT CONCAT( MONTH(expDate), '/', YEAR(expDate)) as expDate, serviceCode, truncatedCard, cardId FROM FYP.card_info WHERE user = '6'";
  $result = $mysqli->query($sql);

  if( $result->num_rows > 0){
  	echo "<table><tr><th>Exp Date</th><th>Service Code</th><th>Card</th></tr>";
  	while($row = $result->fetch_assoc()){
  		echo "<tr><td>".$row['expDate']."</td><td>".$row['serviceCode']."</td><td>".$row['truncatedCard']."</td><td><a href=\"deleteCard.php?card_id=".$row['cardId']."\" >Delete</a></td></tr>";
  	}
  }

?>
