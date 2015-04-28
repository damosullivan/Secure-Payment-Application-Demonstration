<?php
  require_once("database_functions.php");
  require_once("FYP_functions.php");
  #require_once("../validate_functions.php");
  
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
	</head>
	<body>
		<h1>Processing...</h1>

		    <?php
			#DEFEND SQL Injection
			#
			#FILTER INPUT
			#CHECK IT IS AS EXPECTED
			#ESCAPE OUTPUT - mysql real escape string()
			#MAKE SURE INTERGGERS ARE AS EXPECTED (validate/clean) - filtervar($myuserid, FILTER VALIDATE INT);

			
			
			
			
			#SQL INJECTION FIX
			if(true){
			  #NEED TO VALIDATE MUCH MORE!!!
			  $fname = filter_var( $_GET['fname'], FILTER_SANITIZE_MAGIC_QUOTES );
			  $sname = filter_var( $_GET['sname'], FILTER_SANITIZE_MAGIC_QUOTES );
			  $filter_email = filter_var( $_GET['email'], FILTER_VALIDATE_EMAIL );
			  $cleanemail = $mysqli->real_escape_string($filter_email);
			  $pass = hashPass($_GET['pass']);
			  #$cleanemail = $filter_email;
			  
			  if($statement = $mysqli->prepare("INSERT INTO user_info (fName, sName, email, passwordHash) VALUES (?,?,?,?);")){
			    #echo "Statement error".$statement->error;
			    $paramaters = array($fname, $sname, $cleanemail, $pass);
			    
			    
			    if(!$statement->bind_param('ssss', $paramaters)){
			      echo "Bind Error".$statement->error;
			    }
			    if(!$statement->execute()){
			      echo "Execute error".$statement->error;
			    }
			    echo "<p>Done</p>";
			    
			    $statement->close();
			    
			  }else{
			    echo "Statement error".$statement->error;
			  }
			  
			  
			  
			 }else{
			    $fname = $_GET['fname'];
			    $sname = $_GET['sname'];
			    #Name regex - /^[a-z ,.'-]+$/i
			    $email = $_GET['email'];
			    $pass = hashPass($_GET['pass']);
			
			    $sql = "INSERT INTO `FYP`.`user_info` (`fName`, `sName`, `email`, `passwordHash`) VALUES ('" . $celanfname . "', '" . $cleansname . "', '$cleanemail', '$pass');";
			    $result = $mysqli->query($sql);
			    $result->free();
			    echo $sql;
			    
			 }
		    
		    
			
?>


	</body>
</html>
<?php
  $mysqli->close();
  
  #OUTPUT FOOTER!
?>