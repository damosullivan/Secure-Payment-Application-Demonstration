<?php
  require_once("database_functions.php");
  require_once("FYP_functions.php");
  require_once("../mitigate.php");
  #require_once("../validate_functions.php");
  $debug = true;
  $mysqli = new mysqli( 'localhost', 'dos4', 'Password123', 'FYP' );
  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    #exit();
  }else{
    echo "<p>Connected!!</p>";	
  }

  #OUTPUT HEADER
?>
			
<html>
	<head>
		<title>Hello</title>
		<?php
		
		echo mitigate('frameBlock');
		
		
		?>
	</head>
	<body>
		<?php
		  mitigate("frameBlockingLegacy");
		?>

		
		
		
		<h1>Processing...</h1>

		    <?php
			#DEFEND SQL Injection
			#
			#FILTER INPUT
			#CHECK IT IS AS EXPECTED
			#ESCAPE OUTPUT - mysql real escape string()
			#MAKE SURE INTERGGERS ARE AS EXPECTED (validate/clean) - filtervar($myuserid, FILTER VALIDATE INT);

			$fname = $_GET['fname'];
			$sname = $_GET['sname'];
			$email = $_GET['email'];
			$filter_email = filter_var( $email, FILTER_VALIDATE_EMAIL );
			$pass = hashPass($_GET['pass']);
			
			$sqlFname = mitigate("addSlashes", $fname);
			$sqlSname = mitigate("addSlashes", $sname);
			$sqlEmail = mitigate("addSlashes", $filter_email);
			
			$sqlMitigate = array("regularSql" => "INSERT INTO `FYP`.`user_info` (`fName`, `sName`, `email`, `passwordHash`) VALUES ('" . $sqlFname . "', '" . $sqlSname . "', '". $sqlEmail . "', '". $pass. "');",
					 "prepareSql" => "INSERT INTO user_info (fName, sName, email, passwordHash) VALUES (?,?,?,?);",
					 "prepareTypes" => "ssss",
					 "prepareParam" => array(&$sqlFname, &$sqlSname, &$sqlEmail, &$pass)#must be refferences, not values
					 );

			mitigate("preparedStatement", $sqlMitigate);

?>


	</body>
</html>
<?php
  $mysqli->close();
  
  #OUTPUT FOOTER!
?>