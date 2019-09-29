<?php
	include_once(dirname(__FILE__) . "../include/config.php");
	$referAddress = $_SERVER['HTTP_REFERER'];
	if (isset($_GET['enable'])){
		$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE );
		$onlyEnable = $_GET['enable'];

		#$sql = "update code SET state = 0 WHERE idcode > 0";##DO THEM ALL
		#$result = $mysqli->query($sql);

		foreach( $onlyEnable as $name){
			#echo $name."<br />";
			$strings = "UPDATE code SET state = 1 WHERE name = '". $name."';";
			$result = $mysqli->query($strings);
		}

		#$result->free();
		$mysqli->close();


	}
	if(isset($_GET['disable'])){
		$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE );
		$onlyDisable = $_GET['disable'];

		foreach( $onlyDisable as $name){
			#echo $name."<br />";
			$strings = "UPDATE code SET state = 0 WHERE name = '". $name."';";
			$result = $mysqli->query($strings);
		}


	}
header("Location: " . $referAddress);
?>