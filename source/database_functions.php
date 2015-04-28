<?php
    require_once( 'output_functions.php' );
    
    function connect_to_database( $host, $user, $password, $dbname )
    {
        // Try to connect to database
        $dbconnection = mysql_connect( $host, $user, $password );
        if ( ! $dbconnection )
        {
            output_problem_page();
            die();
        }
        // Try to select database
        $dbselection = mysql_select_db( $dbname );
        if ( ! $dbselection )
        {
            output_problem_page();
            die();
        }
        return $dbconnection;
    }
    
    function connect_to_database_new( $host, $user, $password, $dbname )
    {
        // Try to connect to database
        $mysqli = new mysqli($host, $user, $password, $dbname);
        if (mysqli_connect_errno()) {
    			printf("Connect failed: %s\n", mysqli_connect_error());
   			#exit();
			}
        // Try to select database
        
        return $mysqli;
    }
    
    function prepareStatement($preparedStatement, $options){
      $preparedStatement->execute($options);
      return $preparedStatement->fetchAll();
    }
    
    function prepareStatement2($db, $statement, $options){
      $preparedStatement = $db->prepare($statement);
      $preparedStatement->execute($options);
      return $preparedStatement->fetchAll();
    }
    
    function query($db, $query){
      if($result = $db->query($sql)){
	return $result;
      }else{
	return -1;
      }
    }
    
    function output_problem_page()
    {
        output_header( 'Database Problem', 'stylesheet.css' );
        output_paragraph( 'We seem to be experiencing difficulties. Please call back at a later time' );
        output_footer( 'The PHP team' );
    }
?>