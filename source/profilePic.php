<?php

include_once(dirname(__FILE__) . "/include/config.php");
include_once(INCLUDE_DIR . "/" . "htmlFunctions.php");
include_once(INCLUDE_DIR . "/" . "mitigate.php");
include_once(INCLUDE_DIR . "/" . "FYP_functions.php");

session_start();

$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE );#Used till the end

if( !loggedIn($mysqli) ) {
	header( 'Location: logout.php' ) ;
	die("Error: Not logged in");
}else{
	$loggedIn = true;
}

#outputHeader($loggedIn, $mysqli);

$userId = $_SESSION['auth']['user_id'];

#var_dump($_FILES);

echo "<h1>".$_FILES['file']['tmp_name']."</h1>";
echo "<h1>".$_FILES['file']['name']."</h1>";
echo "<h1>".$_SERVER['DOCUMENT_ROOT']."/FYP/Images/</h1>";
echo "<h1>/home/damien/public_html/FYP/Images/hi.jpg</h1>";
echo '<img src="'.$_FILES['file']['tmp_name'].'" />';

$fileNameToSave = $userId."_".$_FILES['file']['name'];
if(isset($_GET['file_name'])){
	$fileNameToSave = $userId."_".$_GET['file_name'];
}

if(move_uploaded_file ( $_FILES['file']['tmp_name'] , IMG_DIR."/".$fileNameToSave)){

	$result = $mysqli->query("UPDATE `FYP`.`user_info` SET `image`='".$fileNameToSave."' WHERE `userId`='".$userId."';");

	if($_SESSION['auth']['imgUrl'] != 'default.jpg'){
		unlink(IMG_DIR."/".$_SESSION['auth']['imgUrl']);
	}
	$_SESSION['auth']['imgUrl'] = $fileNameToSave;

	header( 'Location: home.php' ) ;

}else{
	echo "FAILED!";
}

?>

<!-- array(1) { 
	["file"]=> array(5) 
	{ 
		["name"]=> string(12) "linkedin.jpg" 
		["type"]=> string(10) "image/jpeg" 
		["tmp_name"]=> string(14) "/tmp/phpnVzLXa" 
		["error"]=> int(0) 
		["size"]=> int(127337) 
	} 
} -->
